<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Models\Profile;
use App\Services\ContactService;
use App\Services\ProjectService;
use App\Services\SkillService;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct(
        private ContactService $contactService,
        private ProjectService $projectService,
        private SkillService $skillService
    ) {}

    public function index()
    {
        $profile = Profile::active()->first();
        $featuredProjects = $this->projectService->getFeaturedProjects();
        $skillCategories = $this->skillService->getSkillCategoriesWithSkills();
        $radarChart = $this->skillService->getRadarChartData();

        return view('portfolio.index', compact('profile', 'featuredProjects', 'skillCategories', 'radarChart'));
    }

    public function storeContact(ContactStoreRequest $request)
    {
        $this->contactService->createContact($request->validated(), $request);

        return redirect()->route('portfolio.index')
            ->with('success', 'お問い合わせを送信しました。ありがとうございます。');
    }
}
