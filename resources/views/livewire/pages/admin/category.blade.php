<div>

    @if (session()->has('success'))
    <div>{{ session('success') }}</div>
    @endif

    <!-- form section -->
    <div>
        <form wire:submit="createCategory">
            <div>
                <label for="categoryName">Category Name</label>
                <input wire:model="categoryName" type="text" id="categoryName" />
                @error('categoryName') <span>{{ $message }}</span> @enderror
            </div>

            <div wire:loading.flex wire:target="createCategory">Creating.......</div>
            <div>
                <button type="submit">Create Category</button>
            </div>
        </form>
    </div>


    <!-- data section -->
    <div class="relative overflow-x-auto">
        <!-- table -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Added By
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Added Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="bg-white dark:bg-gray-800">
                    <td class="px-6 py-4">
                        {{$category->id}}
                    </td>
                    <td class="px-6 py-4">
                        {{$category->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$category->user->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$category->created_at}}
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="editButton('{{ $category->id }}', ' {{ $category->name }}')">Edit</button>
                        <button wire:click="deleteButton({{ $category->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- pagination -->
        {{$categories->links()}}
    </div>


    <!-- edit card -->
    @if ($updateCategoryId)
    <div>
        <form wire:submit="updateCategory">
            <div>
                <label for="updateCategoryName">Category Name</label>
                <input wire:model="updateCategoryName" type="text" id="updateCategoryName" />
                @error('updateCategoryName') <span>{{ $message }}</span> @enderror
            </div>

            <div wire:loading.flex wire:target="updateCategory">updating.......</div>
            <div>
                <button type="submit">Update Category</button>
                <button type="button" wire:click="closeEditButton">Close</button>

            </div>
        </form>
    </div>
    @endif

    <!-- delete card -->
    @if ($deleteCategoryId)
    <div>
        <button wire:click="deleteCategory">Delete</button>
        <button wire:click="closeDeleteButton">CLose</button>
    </div>
    @endif
</div>