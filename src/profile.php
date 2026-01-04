<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    
    $avatar = $user['avatar'];
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $upload_dir = 'uploads/avatars/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $avatar = $upload_dir . $user_id . '_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);
    }
    
    $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, phone=?, address=?, avatar=? WHERE id=?");
    $stmt->execute([$name, $email, $phone, $address, $avatar, $user_id]);
    
    $success = "Profile updated successfully!";
    $user = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $user->execute([$user_id]);
    $user = $user->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - TechBro</title>
    <link rel="shortcut icon" href="Image/favico.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="dropdown-fix.css">
</head>
<body class="font-sans bg-gray-50" style="font-family: 'Inter', sans-serif;">
    <?php include 'includes/header.php'; ?>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="text-center mb-6">
                        <?php if ($user['avatar']): ?>
                            <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-gray-200">
                        <?php else: ?>
                            <div class="w-24 h-24 rounded-full mx-auto mb-4 bg-gray-200 flex items-center justify-center border-4 border-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                        <?php endif; ?>
                        <h3 class="text-xl font-bold"><?php echo htmlspecialchars($user['name']); ?></h3>
                        <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                    <nav class="space-y-2">
                        <a href="profile.php" class="flex items-center px-4 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            My Profile
                        </a>
                        <a href="orders.php" class="flex items-center px-4 py-3 hover:bg-gray-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            My Orders
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            Wishlist
                        </a>
                        <a href="logout.php" class="flex items-center px-4 py-3 hover:bg-gray-100 rounded-lg text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            Logout
                        </a>
                    </nav>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="bg-white rounded-xl shadow-sm p-8">
                    <h2 class="text-2xl font-bold mb-6">Profile Information</h2>
                    
                    <?php if (isset($success)): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                            <?php echo $success; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                            <div class="flex items-center gap-4">
                                <?php if ($user['avatar']): ?>
                                    <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar" class="w-20 h-20 rounded-full object-cover border-2 border-gray-300">
                                <?php else: ?>
                                    <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center border-2 border-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="avatar" accept="image/*" class="text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <textarea name="address" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
                        </div>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>
