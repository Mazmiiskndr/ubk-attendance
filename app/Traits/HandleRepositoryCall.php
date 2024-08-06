<?php

namespace App\Traits;

trait HandleRepositoryCall
{
    /**
     * Handles the method call to the repository and manages exceptions.
     * @param string $method The method to call.
     * @param array $parameters The parameters to pass to the method.
     * @throws \InvalidArgumentException If there is an error when calling the method.
     * @return mixed The result of the method call.
     */
    private function handleRepositoryCall(string $method, array $parameters = [])
    {
        try {
            return $this->mainRepository->{$method}(...$parameters);
        } catch (\InvalidArgumentException $e) {
            // Log error or handle it as needed
            \Log::error("Repository call error: " . $e->getMessage());

            // Return null or a specific response as needed
            return null; // Or you could throw a custom exception or return a default value
        }
    }
}
