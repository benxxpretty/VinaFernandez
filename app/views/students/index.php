<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students Table</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-green-50">

  <!-- Sidebar Layout -->
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-green-700 text-white flex flex-col py-8 px-6">
      <div class="mb-10">
        <span class="text-2xl font-bold">Students</span>
      </div>
      <nav class="flex flex-col gap-4">
        <a href="<?=site_url('users/index')?>" class="hover:bg-green-600 px-3 py-2 rounded transition">Student List</a>
        <a href="<?=site_url('users/create')?>" class="hover:bg-green-600 px-3 py-2 rounded transition">Create New User</a>
        <a href="<?=site_url('login')?>" class="hover:bg-green-600 px-3 py-2 rounded transition">Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <h1 class="text-2xl font-bold text-green-700 mb-6">Students List</h1>

      <!-- Search Bar -->
      <form method="get" action="<?=site_url('users/index')?>" class="flex gap-2 mb-6 max-w-md">
        <input 
          type="text" 
          name="q" 
          value="<?=html_escape($_GET['q'] ?? '')?>" 
          placeholder="Search student..." 
          class="px-3 py-2 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-300"
        >
        <button 
          type="submit" 
          class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded transition"
        >
          Search
        </button>
      </form>

      <!-- Table -->
      <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full text-center border-collapse">
          <thead>
            <tr class="bg-green-100 text-green-700">
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Lastname</th>
              <th class="py-3 px-4">Firstname</th>
              <th class="py-3 px-4">Email</th>
              <th class="py-3 px-4">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach(html_escape($users) as $user): ?>
              <tr class="hover:bg-green-50">
                <td class="py-2 px-4"><?=($user['id']);?></td>
                <td class="py-2 px-4"><?=($user['last_name']);?></td>
                <td class="py-2 px-4"><?=($user['first_name']);?></td>
                <td class="py-2 px-4"><?=($user['email']);?></td>
                <td class="py-2 px-4">
                  <a href ="<?=site_url('users/update/'.$user['id']);?>" class="text-green-700 hover:underline font-semibold">Update</a> |
                  <a href ="<?=site_url('users/delete/'.$user['id']);?>" onclick="return confirm('Are you sure you want to delete this record?');" class="text-red-600 hover:underline font-semibold">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-6 flex justify-center">
        <?php if (isset($page)): ?>
          <div class="inline-flex gap-1">
            <?= str_replace(
              [
                '<a ',
                '<strong class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 ">',
                '</strong>'
              ],
              [
                '<a class="px-3 py-1 rounded border border-green-200 bg-white hover:bg-green-100 text-green-700 transition" ',
                '<span class="px-3 py-1 rounded bg-green-600 text-white font-bold">',
                '</span>'
              ],
              $page
            ); ?>
          </div>
        <?php endif; ?>
      </div>
    </main>
  </div>
</body>
</html>