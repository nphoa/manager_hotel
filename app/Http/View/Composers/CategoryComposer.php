<?php

namespace App\Http\View\Composers;
use App\Repositories\Eloquents\CategoryRepository;
use Illuminate\View\View;

class CategoryComposer {
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function compose(View $view){
        $view->with('categories',$this->categoryRepository->getAll());
    }
}