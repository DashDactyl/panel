<?php

namespace DASHDACTYL\Services\Subusers;

use Illuminate\Support\Str;
use DASHDACTYL\Models\Server;
use DASHDACTYL\Models\Subuser;
use Illuminate\Database\ConnectionInterface;
use DASHDACTYL\Services\Users\UserCreationService;
use DASHDACTYL\Repositories\Eloquent\SubuserRepository;
use DASHDACTYL\Contracts\Repository\UserRepositoryInterface;
use DASHDACTYL\Exceptions\Repository\RecordNotFoundException;
use DASHDACTYL\Exceptions\Service\Subuser\UserIsServerOwnerException;
use DASHDACTYL\Exceptions\Service\Subuser\ServerSubuserExistsException;

class SubuserCreationService
{
    /**
     * SubuserCreationService constructor.
     */
    public function __construct(
        private ConnectionInterface $connection,
        private SubuserRepository $subuserRepository,
        private UserCreationService $userCreationService,
        private UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * Creates a new user on the system and assigns them access to the provided server.
     * If the email address already belongs to a user on the system a new user will not
     * be created.
     *
     * @throws \DASHDACTYL\Exceptions\Model\DataValidationException
     * @throws \DASHDACTYL\Exceptions\Service\Subuser\ServerSubuserExistsException
     * @throws \DASHDACTYL\Exceptions\Service\Subuser\UserIsServerOwnerException
     * @throws \Throwable
     */
    public function handle(Server $server, string $email, array $permissions): Subuser
    {
        return $this->connection->transaction(function () use ($server, $email, $permissions) {
            try {
                $user = $this->userRepository->findFirstWhere([['email', '=', $email]]);

                if ($server->owner_id === $user->id) {
                    throw new UserIsServerOwnerException(trans('exceptions.subusers.user_is_owner'));
                }

                $subuserCount = $this->subuserRepository->findCountWhere([['user_id', '=', $user->id], ['server_id', '=', $server->id]]);
                if ($subuserCount !== 0) {
                    throw new ServerSubuserExistsException(trans('exceptions.subusers.subuser_exists'));
                }
            } catch (RecordNotFoundException) {
                // Just cap the username generated at 64 characters at most and then append a random string
                // to the end to make it "unique"...
                $username = substr(preg_replace('/([^\w\.-]+)/', '', strtok($email, '@')), 0, 64) . Str::random(3);

                $user = $this->userCreationService->handle([
                    'email' => $email,
                    'username' => $username,
                    'root_admin' => false,
                ]);
            }

            return $this->subuserRepository->create([
                'user_id' => $user->id,
                'server_id' => $server->id,
                'permissions' => array_unique($permissions),
            ]);
        });
    }
}