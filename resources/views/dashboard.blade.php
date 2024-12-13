@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h2>
        <p class="mt-2 text-gray-600">Let's help save the Earth together</p>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-8">
        <!-- Total Points (Wider) -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Points</h3>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format(auth()->user()->points) }}</p>
                </div>
            </div>
            <a href="{{ route('rewards.index') }}" class="mt-4 inline-flex items-center text-sm text-green-600 hover:text-green-700">
                Redeem points
                <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

 <!-- Related Articles Section (Placed Below Total Points) -->
 <div class="bg-white rounded-xl shadow-sm mb-8">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="text-lg font-medium text-gray-900">Related Articles</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                [
                    'title' => 'How to Properly Recycle Plastic',
                    'url' => 'https://sensoneo.com/waste-library/how-to-properly-recycle-plastic/',
                    'image' => 'https://via.placeholder.com/300x200',
                    'description' => 'Learn the best practices for recycling different types of plastic waste.',
                ],
                [
                    'title' => 'Composting 101: A Beginner\'s Guide',
                    'url' => 'https://extension.wvu.edu/natural-resources/soil-water/composting-for-beginners',
                    'image' => 'https://via.placeholder.com/300x200',
                    'description' => 'Start your composting journey with this comprehensive guide.',
                ],
                [
                    'title' => 'Reducing Household Waste',
                    'url' => 'https://www.addisoncountyrecycles.org/recycling/reduce-reuse/plastics-reduction',
                    'image' => 'https://via.placeholder.com/300x200',
                    'description' => 'Tips and tricks to minimize waste in your daily life.',
                ],
            ] as $article)
                <div class="bg-white rounded-lg overflow-hidden border border-gray-100">
                    <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-medium text-gray-900 mb-2">
                            @isset($article['url'])
                                <a href="{{ $article['url'] }}" target="_blank" class="text-blue-600 hover:text-blue-700">{{ $article['title'] }}</a>
                            @else
                                {{ $article['title'] }}
                            @endisset
                        </h4>
                        <p class="text-sm text-gray-500 mb-4">{{ $article['description'] }}</p>
                        @isset($article['url'])
                            <a href="{{ $article['url'] }}" target="_blank" class="text-green-600 hover:text-green-700 text-sm font-medium">
                                Read more →
                            </a>
                        @else
                            <span class="text-gray-400 text-sm">No link available</span>
                        @endisset
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection
