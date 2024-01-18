<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Category as ModelsCategory;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{

    use WithPagination;

    #[Validate("required|unique:categories,name")]
    public $categoryName;

    public $updateCategoryName;
    public $updateCategoryId;

    public $deleteCategoryId;


    public function editButton($categoryId, $categoryName)
    {
        $this->updateCategoryId = $categoryId;
        $this->updateCategoryName = $categoryName;
    }


    public function closeEditButton()
    {
        $this->updateCategoryId = null;
    }

    public function deleteButton($categoryId)
    {
        $this->deleteCategoryId = $categoryId;
    }

    public function closeDeleteButton()
    {
        $this->deleteCategoryId = null;
    }


    public function deleteCategory()
    {
        ModelsCategory::find($this->deleteCategoryId)->delete();
        $this->deleteCategoryId = "";
    }

    public function updateCategory()
    {
        $this->validate([
            "updateCategoryName" => "required|unique:categories,name"
        ]);

        $category = ModelsCategory::find($this->updateCategoryId);
        $category->update([
            'name' => $this->updateCategoryName
        ]);

        $this->updateCategoryId = null;
    }

    public function createCategory()
    {
        $this->validate([
            "categoryName" => "required|unique:categories,name"
        ]);

        ModelsCategory::create([
            'name' => $this->categoryName,
            "user_id" => 1
        ]);

        session()->flash('success', 'Category created successfully.');
        $this->reset();
    }

    public function render()
    {

        $categories = ModelsCategory::latest()->paginate(3);
        return view('livewire.pages.admin.category', compact("categories"));
    }
}
