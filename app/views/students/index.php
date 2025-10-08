<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users</title>
  <link rel="stylesheet" href="<?=base_url();?>public/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen font-sans bg-gradient-to-br from-pink-100 via-white to-pink-50 flex items-center justify-center px-4">

  <!-- Main Content -->
  <div class="bg-white border border-pink-200 shadow-lg rounded-2xl p-8 w-full max-w-4xl">

    <!-- Header (Centered Title) -->
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-3xl font-bold text-pink-600">Students List</h1>
      <a href="<?=site_url('login')?>" class="bg-pink-500 hover:bg-pink-600 text-white font-bold px-4 py-2 rounded-full shadow transition duration-200">
        Logout
      </a>
    </div>

    <!-- Server-side search form with search icon -->
<div class="flex justify-center mb-6">
  <form action="<?= site_url('students/index'); ?>" method="get"
        class="flex items-center w-full max-w-md bg-white border border-pink-300 rounded-full shadow-sm overflow-hidden">
      
      <?php
      $q = '';
      if(isset($_GET['q'])) {
          $q = $_GET['q'];
      }
      ?>

      <!-- Icon + Input -->
      <div class="flex items-center w-full px-3">
            <!-- Search Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                fill="none" viewBox="0 0 24 24" 
                stroke-width="2" stroke="currentColor" 
                class="w-5 h-5 text-pink-500">
              <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" />
            </svg>

            <!-- Input -->
            <input 
              type="text" 
              name="q" 
              placeholder="Search records..." 
              value="<?= html_escape($q); ?>" 
              id="searchBox"
              class="w-full px-3 py-2 text-gray-700 focus:outline-none"
            >
          </div>

          <!-- Button -->
          <button 
            type="submit" 
            class="bg-pink-500 hover:bg-pink-600 text-white font-bold px-5 py-2 rounded-r-full transition duration-200"
          >
            Search
          </button>
      </form>
    </div>


    <!-- Table -->
    <div class="overflow-x-auto rounded-lg">
      <table class="w-full text-center border border-black">
        <thead>
          <tr class="bg-pink-200 text-black text-lg border border-black">
            <th class="py-3 px-4 border border-black">ID</th>
            <th class="py-3 px-4 border border-black">Lastname</th>
            <th class="py-3 px-4 border border-black">Firstname</th>
            <th class="py-3 px-4 border border-black">Email</th>
            <?php if ($current_role === 'admin'): ?>
            <th class="py-3 px-4 border border-black">Action</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach(html_escape($users) as $user): ?>
            <tr class="hover:bg-pink-100 transition duration-200 border border-black">
              <td class="py-3 px-4 font-semibold text-pink-800 border border-black"><?=($user['id']);?></td>
              <td class="py-3 px-4 text-gray-700 border border-black"><?=($user['last_name']);?></td>
              <td class="py-3 px-4 text-gray-700 border border-black"><?=($user['first_name']);?></td>
              <td class="py-3 px-4 border border-black">
                <span class="bg-pink-100 text-pink-700 text-sm font-medium px-3 py-1 rounded-full">
                  <?=($user['email']);?>
                </span>
              </td>
              <?php if ($current_role === 'admin'): ?>
              <td class="py-3 px-4 border border-black">
                <a href="<?=site_url('students/update/'.$user['id']);?>" class="text-pink-600 hover:text-pink-800 font-bold mr-2">Update</a>
                |
                <a href="<?=site_url('students/delete/'.$user['id']);?>" onclick="return confirm('Are you sure you want to delete this record?');" class="text-red-500 hover:text-red-700 font-bold ml-2">Delete</a>
              </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination links -->
    <div class="pagination-container mt-6 flex justify-center">
      <div class="inline-flex items-center space-x-2">
        <?php if (isset($page)): ?>
          <?= str_replace(
              ['<a ', '<strong class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 hover:bg-indigo-50">', '</strong>'],
              [
                  '<a class="px-4 py-2 border border-pink-300 rounded-full text-pink-600 hover:bg-pink-100 transition duration-200" ',
                  '<span class="px-4 py-2 bg-pink-600 text-white rounded-full font-extrabold text-lg ring-2 ring-pink-300 shadow-lg">',
                  '</span>'
              ],
              $page
          ); ?>
        <?php endif; ?>
      </div>
    </div>


    <!-- Create New User Button (Below Table, Centered) -->
    <div class="mt-6 text-center">
      <?php if ($current_role === 'admin'): ?>
      <a href="<?=site_url('students/create')?>" class="bg-pink-500 hover:bg-pink-600 text-white font-bold px-6 py-2 rounded-full shadow transition duration-200">
        + Create New Student
      </a>
      <?php endif; ?>
    </div>

  </div>

</body>
</html>