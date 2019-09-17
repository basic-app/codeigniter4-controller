<?php

namespace denis303\codeigniter4;

abstract class Controller extends \CodeIgniter\Controller
{

    protected $layout = "layout";

    protected function render(string $view, array $params = [])
    {
        $content = view($view, $params, ['saveData' => true]);

        $layout = $this->layout;

        $data = Services::renderer()->getData();

        if (array_key_exists('layout', $data))
        {
            $layout = $data['layout'];
        }

        if ($layout)
        {
            return view($this->layout, ['content' => $content], ['saveData' => false]);
        }

        return $content;
    }

    public function goHome()
    {
        return redirect()->to(base_url());
    }

    public function goBack()
    {
        return redirect()->back();
    }

}