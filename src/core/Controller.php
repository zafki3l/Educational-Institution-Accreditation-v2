<?php

namespace Core;

/**
 * Class Controller
 * 
 * BaseController provides helper methods for All Controller classes
 */
abstract class Controller
{
    /**
     * Render a specified view 
     * @param string $view
     * @param array $data
     * @return mixed
     */
    public function render(string $view, array $data = []): mixed
    {
        extract($data);

        return require dirname(__DIR__) . "/app/{$view}.php";
    }

    /**
     * Render a view with a layout
     * 
     * @param string $view
     * @param string $layout_view
     * @param string $title
     * @param array $data
     * @return mixed
     */
    protected function view(string $view, string $layout, array $data = []): mixed
    {
        ob_start();

        // App\Modules\Home\Presentation\Controllers\HomeController        
        $module = $this->getModuleName();

        $path = "Modules/{$module}/Presentation/Views/{$view}";

        $this->render($path, $data);

        $view_data = [
            'title' => $data['title'] ?? 'Document',
            'content' => ob_get_clean(),
        ];

        return $this->render('Shared/Views/layouts/main-layouts/' . $layout, $view_data);
    }

    protected function getModuleName(): string
    {
        $class = static::class;

        preg_match('/Modules\\\\([^\\\\]+)/', $class, $matches);

        return $matches[1] ?? throw new \Exception("Module not found in namespace");
    }
}
