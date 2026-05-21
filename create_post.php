<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';
require_once 'includes/ai.php';

requireLogin();

$generatedCaption = '';
$error = '';
$topic = '';
$platform = 'Instagram';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'generate') {
        $topic = trim($_POST['topic'] ?? '');
        $platform = $_POST['platform'] ?? 'Instagram';

        if (!empty($topic)) {
            // Note: Make sure OPENROUTER_API_KEY is configured in includes/ai.php
            $caption = generateCaptionWithAI($topic, $platform);

            if ($caption) {
                $generatedCaption = $caption;
            } else {
                $error = "Failed to generate caption. Please check your API key and try again.";
            }
        } else {
            $error = "Please enter a topic to generate a caption.";
        }
    }
}

include 'templates/header.php';
?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Create New Post</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- AI Generator Section -->
            <div class="bg-white overflow-hidden shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">AI Caption Generator</h2>

                <?php if ($error): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="action" value="generate">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="platform">Platform</label>
                        <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="platform" name="platform">
                            <option value="Instagram" <?= $platform === 'Instagram' ? 'selected' : '' ?>>Instagram</option>
                            <option value="Facebook" <?= $platform === 'Facebook' ? 'selected' : '' ?>>Facebook</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="topic">What's your post about?</label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-24" id="topic" name="topic" placeholder="e.g., A new summer sale starting next week with 50% off..."><?= htmlspecialchars($topic) ?></textarea>
                    </div>

                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full flex justify-center items-center" type="submit">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Generate with AI
                    </button>
                </form>
            </div>

            <!-- Editor Section -->
            <div class="bg-white overflow-hidden shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Post Content</h2>
                <form method="POST" action="scheduler.php">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="caption">Final Caption</label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-64" id="caption" name="caption" placeholder="Your caption will appear here..."><?= htmlspecialchars($generatedCaption) ?></textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Save Draft
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="alert('Scheduling functionality coming soon!');">
                            Schedule Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>