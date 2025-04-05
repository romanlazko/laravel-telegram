<?php

namespace Romanlazko\LaravelTelegram\Concerns;

use Closure;

trait HasRoles
{
    protected array $roles = [
        'user' => [],
    ];

    public function defineRoleForPrivateChat(string $role, array|Closure $roleIds): static
    {
        $this->roles[$role] = $roleIds;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = array_map(function ($roleIds) {
            return $this->evaluate($roleIds);
        }, $this->roles);

        if (empty($roles)) {
            throw new \Exception('Roles not found');
        }

        foreach ($roles as $role => $roleIds) {
            if (! is_array($roleIds)) {
                throw new \Exception("Role [{$role}] must be an array of role IDs");
            }

            $roleIds = array_map(function ($roleId) {
                if (! is_numeric($roleId)) {
                    throw new \Exception("Role ID [{$roleId}] must be a number");
                }

                return $roleId;
            }, $roleIds);
        }

        return $roles;
    }
}
