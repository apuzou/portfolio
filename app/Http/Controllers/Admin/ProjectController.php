<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['categories', 'technologies'])->orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = ProjectCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
            'categories' => 'array',
            'categories.*' => 'exists:project_categories,id',
            'technologies' => 'array',
            'technologies.*' => 'string|max:100',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'content' => $request->content,
            'demo_url' => $request->demo_url,
            'github_url' => $request->github_url,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        // 画像アップロード
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('projects', 'public');
            $project->update(['featured_image' => $path]);
        }

        // カテゴリの関連付け
        if ($request->has('categories')) {
            $project->categories()->sync($request->categories);
        }

        // 技術スタックの保存
        if ($request->has('technologies')) {
            $project->technologies()->delete(); // 既存の技術スタックを削除
            foreach ($request->technologies as $tech) {
                if (!empty($tech)) {
                    $project->technologies()->create(['name' => $tech]);
                }
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'プロジェクトが作成されました。');
    }

    public function show(Project $project)
    {
        $project->load(['categories', 'technologies']);
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $categories = ProjectCategory::where('is_active', true)->orderBy('sort_order')->get();
        $project->load(['categories', 'technologies']);
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
            'categories' => 'array',
            'categories.*' => 'exists:project_categories,id',
            'technologies' => 'array',
            'technologies.*' => 'string|max:100',
        ]);

        $project->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'content' => $request->content,
            'demo_url' => $request->demo_url,
            'github_url' => $request->github_url,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        // 画像アップロード
        if ($request->hasFile('featured_image')) {
            // 古い画像を削除
            if ($project->featured_image) {
                Storage::disk('public')->delete($project->featured_image);
            }
            $path = $request->file('featured_image')->store('projects', 'public');
            $project->update(['featured_image' => $path]);
        }

        // カテゴリの関連付け
        if ($request->has('categories')) {
            $project->categories()->sync($request->categories);
        }

        // 技術スタックの更新
        if ($request->has('technologies')) {
            $project->technologies()->delete(); // 既存の技術スタックを削除
            foreach ($request->technologies as $tech) {
                if (!empty($tech)) {
                    $project->technologies()->create(['name' => $tech]);
                }
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'プロジェクトが更新されました。');
    }

    public function destroy(Project $project)
    {
        // 画像を削除
        if ($project->featured_image) {
            Storage::disk('public')->delete($project->featured_image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index')
            ->with('success', 'プロジェクトが削除されました。');
    }
}
