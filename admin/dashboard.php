<?php
session_start();
if(!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$data = json_decode(file_get_contents('../config/database.json'), true);

// Handle Form Submission
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update Hero Section
    // Update Hero Section
$data['hero'] = [
    'title' => $_POST['hero']['title'] ?? '',
    'subtitle' => $_POST['hero']['subtitle'] ?? '',
    'button_text' => $_POST['hero']['button_text'] ?? '',
    'profile_image' => $_POST['hero']['profile_image'] ?? '',
    'scroll_text' => $_POST['hero']['scroll_text'] ?? ''
];

    // Update Social Media
    $data['social'] = [];
    foreach($_POST['social'] as $social) {
        if(!empty($social['platform']) && !empty($social['url'])) {
            $data['social'][] = [
                'platform' => $social['platform'],
                'url' => $social['url']
            ];
        }
    }
    
    // Add New Social Media
    if(!empty($_POST['new_social']['platform'])) {
        $data['social'][] = [
            'platform' => $_POST['new_social']['platform'],
            'url' => $_POST['new_social']['url']
        ];
    }

    // Update Contact Methods
    $data['contact'] = [];
    foreach($_POST['contacts'] as $contact) {
        if(!empty($contact['platform'])) {
            $data['contact'][] = [
                'platform' => $contact['platform'],
                'url' => $contact['url'],
                'icon' => $contact['icon']
            ];
        }
    }
    
    // Add New Contact Method
    if(!empty($_POST['new_contact']['platform'])) {
        $data['contact'][] = [
            'platform' => $_POST['new_contact']['platform'],
            'url' => $_POST['new_contact']['url'],
            'icon' => $_POST['new_contact']['icon']
        ];
    }

    // Update Projects
    $data['projects'] = [];
    foreach($_POST['projects'] as $project) {
        if(!empty($project['title'])) {
            $data['projects'][] = [
                'title' => $project['title'],
                'description' => $project['description'],
                'image' => $project['image'],
                'category' => $project['category'],
                'tags' => explode(',', $project['tags'])
            ];
        }
    }

    // Add New Project
    if(!empty($_POST['new_project']['title'])) {
        $data['projects'][] = [
            'title' => $_POST['new_project']['title'],
            'description' => $_POST['new_project']['description'],
            'image' => $_POST['new_project']['image'],
            'category' => $_POST['new_project']['category'],
            'tags' => explode(',', $_POST['new_project']['tags'])
        ];
    }

    // Update Skills
    $data['skills'] = [];
    foreach($_POST['skills'] as $skill) {
        if(!empty($skill['name'])) {
            $data['skills'][] = [
                'name' => $skill['name'],
                'icon' => $skill['icon'],
                'experience' => $skill['experience']
            ];
        }
    }

    // Add New Skill
    if(!empty($_POST['new_skill']['name'])) {
        $data['skills'][] = [
            'name' => $_POST['new_skill']['name'],
            'icon' => $_POST['new_skill']['icon'],
            'experience' => $_POST['new_skill']['experience']
        ];
    }

    file_put_contents('../config/database.json', json_encode($data, JSON_PRETTY_PRINT));
    $success = "All changes saved successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-[Poppins] bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-[#6879EF]">RAFIE Admin Dashboard</h1>
                <div class="flex items-center gap-4">
                    <span class="text-gray-600"><i class="fas fa-user-circle mr-2"></i><?= $_SESSION['username'] ?></span>
                    <a href="logout.php" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <?php if(isset($success)): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <?= $success ?>
        </div>
        <?php endif; ?>

        <form method="POST" class="space-y-8">
        
            <!-- Hero Section Form -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-2xl font-bold text-[#6879EF] mb-6">
        <i class="fas fa-heading mr-2"></i>Hero Section
    </h2>
    <div class="grid grid-cols-1 gap-6">
        <div>
            <label class="block text-gray-700 mb-2 font-medium">Title</label>
            <input type="text" name="hero[title]" 
                value="<?= $data['hero']['title'] ?>" 
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#6879EF]">
        </div>
        <div>
            <label class="block text-gray-700 mb-2 font-medium">Subtitle</label>
            <textarea name="hero[subtitle]" 
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#6879EF] h-32"><?= $data['hero']['subtitle'] ?></textarea>
        </div>
        <div>
            <label class="block text-gray-700 mb-2 font-medium">Button Text</label>
            <input type="text" name="hero[button_text]" 
                value="<?= $data['hero']['button_text'] ?>" 
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#6879EF]">
        </div>
        <div>
            <label class="block text-gray-700 mb-2 font-medium">Profile Image URL</label>
            <input type="text" name="hero[profile_image]" 
                value="<?= $data['hero']['profile_image'] ?>" 
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#6879EF]">
        </div>
        <div>
            <label class="block text-gray-700 mb-2 font-medium">Scroll Text</label>
            <input type="text" name="hero[scroll_text]" 
                value="<?= $data['hero']['scroll_text'] ?>" 
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#6879EF]">
        </div>
    </div>
</div>

<!-- Social Media Section -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-2xl font-bold text-[#6879EF] mb-6">
        <i class="fas fa-share-alt mr-2"></i>Social Media
    </h2>
    <div class="space-y-6">
        <?php foreach($data['social'] as $index => $social): ?>
        <div class="border-l-4 border-[#6879EF] pl-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600 mb-2">Platform</label>
                    <input type="text" name="social[<?= $index ?>][platform]" 
                        value="<?= $social['platform'] ?>" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-600 mb-2">URL</label>
                    <input type="url" name="social[<?= $index ?>][url]" 
                        value="<?= $social['url'] ?>" class="w-full p-2 border rounded">
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
        <!-- New Social Media -->
        <div class="border-l-4 border-dashed border-[#6879EF] pl-4 pt-6">
            <h3 class="text-lg font-bold text-[#6879EF] mb-4">Add New Social Media</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600 mb-2">Platform</label>
                    <input type="text" name="new_social[platform]" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-600 mb-2">URL</label>
                    <input type="url" name="new_social[url]" class="w-full p-2 border rounded">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Methods Section -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-2xl font-bold text-[#6879EF] mb-6">
        <i class="fas fa-address-book mr-2"></i>Contact Methods
    </h2>
    <div class="space-y-6">
        <?php foreach($data['contact'] as $index => $contact): ?>
        <div class="border-l-4 border-[#6879EF] pl-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600 mb-2">Platform</label>
                    <input type="text" name="contacts[<?= $index ?>][platform]" 
                        value="<?= $contact['platform'] ?>" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-600 mb-2">URL</label>
                    <input type="url" name="contacts[<?= $index ?>][url]" 
                        value="<?= $contact['url'] ?>" class="w-full p-2 border rounded">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-600 mb-2">Icon Class</label>
                    <input type="text" name="contacts[<?= $index ?>][icon]" 
                        value="<?= $contact['icon'] ?>" class="w-full p-2 border rounded">
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
        <!-- New Contact Method -->
        <div class="border-l-4 border-dashed border-[#6879EF] pl-4 pt-6">
            <h3 class="text-lg font-bold text-[#6879EF] mb-4">Add New Contact Method</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600 mb-2">Platform</label>
                    <input type="text" name="new_contact[platform]" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-600 mb-2">URL</label>
                    <input type="url" name="new_contact[url]" class="w-full p-2 border rounded">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-600 mb-2">Icon Class</label>
                    <input type="text" name="new_contact[icon]" class="w-full p-2 border rounded">
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Projects Section -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-[#6879EF] mb-6"><i class="fas fa-folder-open mr-2"></i>Projects</h2>
                <div class="space-y-6">
                    <?php foreach($data['projects'] as $index => $project): ?>
                    <div class="border-l-4 border-[#6879EF] pl-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-600 mb-2">Title</label>
                                <input type="text" name="projects[<?= $index ?>][title]" 
                                    value="<?= $project['title'] ?>" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Category</label>
                                <input type="text" name="projects[<?= $index ?>][category]" 
                                    value="<?= $project['category'] ?>" class="w-full p-2 border rounded">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-600 mb-2">Description</label>
                                <textarea name="projects[<?= $index ?>][description]" 
                                    class="w-full p-2 border rounded h-24"><?= $project['description'] ?></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Image URL</label>
                                <input type="text" name="projects[<?= $index ?>][image]" 
                                    value="<?= $project['image'] ?>" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Tags (comma separated)</label>
                                <input type="text" name="projects[<?= $index ?>][tags]" 
                                    value="<?= implode(',', $project['tags']) ?>" class="w-full p-2 border rounded">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <!-- New Project -->
                    <div class="border-l-4 border-dashed border-[#6879EF] pl-4 pt-6">
                        <h3 class="text-lg font-bold text-[#6879EF] mb-4">Add New Project</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-600 mb-2">Title</label>
                                <input type="text" name="new_project[title]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Category</label>
                                <input type="text" name="new_project[category]" class="w-full p-2 border rounded">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-600 mb-2">Description</label>
                                <textarea name="new_project[description]" class="w-full p-2 border rounded h-24"></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Image URL</label>
                                <input type="text" name="new_project[image]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Tags (comma separated)</label>
                                <input type="text" name="new_project[tags]" class="w-full p-2 border rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-[#6879EF] mb-6"><i class="fas fa-cog mr-2"></i>Skills</h2>
                <div class="space-y-6">
                    <?php foreach($data['skills'] as $index => $skill): ?>
                    <div class="border-l-4 border-[#6879EF] pl-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-600 mb-2">Skill Name</label>
                                <input type="text" name="skills[<?= $index ?>][name]" 
                                    value="<?= $skill['name'] ?>" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Icon Class</label>
                                <input type="text" name="skills[<?= $index ?>][icon]" 
                                    value="<?= $skill['icon'] ?>" class="w-full p-2 border rounded">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-600 mb-2">Experience</label>
                                <input type="text" name="skills[<?= $index ?>][experience]" 
                                    value="<?= $skill['experience'] ?>" class="w-full p-2 border rounded">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <!-- New Skill -->
                    <div class="border-l-4 border-dashed border-[#6879EF] pl-4 pt-6">
                        <h3 class="text-lg font-bold text-[#6879EF] mb-4">Add New Skill</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-600 mb-2">Skill Name</label>
                                <input type="text" name="new_skill[name]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Icon Class</label>
                                <input type="text" name="new_skill[icon]" class="w-full p-2 border rounded">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-600 mb-2">Experience</label>
                                <input type="text" name="new_skill[experience]" class="w-full p-2 border rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="sticky bottom-0 bg-white py-4 border-t">
                <button type="submit" 
                    class="w-full bg-[#6879EF] text-white px-6 py-3 rounded-lg hover:bg-[#5a6ad8] transition-all font-medium">
                    <i class="fas fa-save mr-2"></i>Save All Changes
                </button>
            </div>
        </form>
    </div>
</body>
</html>