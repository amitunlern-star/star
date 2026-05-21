<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

requireLogin();

include 'templates/header.php';
?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="flex flex-col space-y-3">
                        <a href="create_post.php" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                            Create New Post
                        </a>
                        <a href="social_connect.php" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50">
                            Connect Social Accounts
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Overview (Placeholder) -->
            <div class="bg-white overflow-hidden shadow rounded-lg md:col-span-2">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Overview</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 font-medium">Scheduled Posts</p>
                            <p class="text-2xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 font-medium">Published This Week</p>
                            <p class="text-2xl font-bold text-gray-900">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Activity</h3>
            </div>
            <ul role="list" class="divide-y divide-gray-200">
                <li class="px-4 py-4 sm:px-6 text-gray-500 text-center text-sm">
                    No recent activity found. Connect your social accounts and start posting!
                </li>
            </ul>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>