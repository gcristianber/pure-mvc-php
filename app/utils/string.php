<?php


if (!function_exists('view')) {
    function view(string $viewPath, array $params = []): void
    {
        // Checks if the path contains forward slashes instead of backward slashes.
        if (str_contains($viewPath, '')) {
            $viewPath = str_replace('/', '\\', $viewPath);
        }

        // Concatenate the passed parameter values to create a view path.
        $viewPath = $_SERVER['DOCUMENT_ROOT'] . "\\src\\views\\" . $viewPath . ".view.php";

        // Checks if the file exists.
        if (!file_exists($viewPath)) {
            view('errors/404');
            exit;
        }

        // Extract the parameters to be treated as a variable.
        if (!empty($params)) {
            extract($params);
        }

        // Requiring a view file to render.
        require($viewPath);
    }
}

if (!function_exists('hash_password')) {
    /**
     * By default it uses the ARGON2I.
     */
    function hash_password(string $password, $encryptor = PASSWORD_ARGON2I, $options = [
        'memory_cost' => 1 << 14, // 16 MiB
        'time_cost'   => 4,       // 4 passes
        'threads'     => 2,       // 2 threads
    ]): string
    {
        return password_hash($password, $encryptor, $options);
    }
}

if (!function_exists('hash_password_verify')) {
    /**
     * Verifies the password if it is match.
     */
    function hash_password_verify(string $password): bool
    {
        $hash = hash_password($password);

        if (!password_verify($password, $hash)) {
            return false;
        }

        return true;
    }
}
