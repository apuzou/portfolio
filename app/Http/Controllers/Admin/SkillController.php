<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::with('skillCategory')->orderBy('sort_order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        $categories = SkillCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.skills.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skill_category_id' => 'required|exists:skill_categories,id',
            'name' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        Skill::create([
            'skill_category_id' => $request->skill_category_id,
            'name' => $request->name,
            'level' => $request->level,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.skills.index')
            ->with('success', 'スキルが作成されました。');
    }

    public function show(Skill $skill)
    {
        $skill->load('skillCategory');
        return view('admin.skills.show', compact('skill'));
    }

    public function edit(Skill $skill)
    {
        $categories = SkillCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'skill_category_id' => 'required|exists:skill_categories,id',
            'name' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $skill->update([
            'skill_category_id' => $request->skill_category_id,
            'name' => $request->name,
            'level' => $request->level,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.skills.index')
            ->with('success', 'スキルが更新されました。');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')
            ->with('success', 'スキルが削除されました。');
    }
}
