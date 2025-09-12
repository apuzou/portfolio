<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::orderBy('sort_order')->get();
        return view('admin.project-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.project-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        ProjectCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.project-categories.index')
            ->with('success', 'プロジェクトカテゴリが作成されました。');
    }

    public function show(ProjectCategory $projectCategory)
    {
        return view('admin.project-categories.show', compact('projectCategory'));
    }

    public function edit(ProjectCategory $projectCategory)
    {
        return view('admin.project-categories.edit', compact('projectCategory'));
    }

    public function update(Request $request, ProjectCategory $projectCategory)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $projectCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.project-categories.index')
            ->with('success', 'プロジェクトカテゴリが更新されました。');
    }

    public function destroy(ProjectCategory $projectCategory)
    {
        $projectCategory->delete();
        return redirect()->route('admin.project-categories.index')
            ->with('success', 'プロジェクトカテゴリが削除されました。');
    }
}
