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