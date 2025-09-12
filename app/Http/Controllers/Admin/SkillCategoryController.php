<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillCategoryController extends Controller
{
    public function index()
    {
        $categories = SkillCategory::orderBy('sort_order')->get();
        return view('admin.skill-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.skill-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        SkillCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.skill-categories.index')
            ->with('success', 'スキルカテゴリが作成されました。');
    }

    public function show(SkillCategory $skillCategory)
    {
        return view('admin.skill-categories.show', compact('skillCategory'));
    }

    public function edit(SkillCategory $skillCategory)
    {
        return view('admin.skill-categories.edit', compact('skillCategory'));
    }

    public function update(Request $request, SkillCategory $skillCategory)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $skillCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.skill-categories.index')
            ->with('success', 'スキルカテゴリが更新されました。');
    }

    public function destroy(SkillCategory $skillCategory)
    {
        $skillCategory->delete();
        return redirect()->route('admin.skill-categories.index')
            ->with('success', 'スキルカテゴリが削除されました。');
    }
}
