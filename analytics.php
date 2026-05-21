<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

requireLogin();

include 'templates/header.php';
?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Analytics Dashboard</h1>
        <div class="bg-white overflow-hidden shadow rounded-lg p-6">
            <p class="text-gray-600">Engagement analytics and competitor analysis charts will be implemented here.</p>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>