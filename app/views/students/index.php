<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Records Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      background-attachment: fixed;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
      font-family: 'Poppins', sans-serif;
    }
    .glass-effect {
      background: rgba(255, 255, 255, 0.92);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1), 0 5px 15px rgba(0,0,0,0.07);
    }
    .gradient-text {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0.5rem;
      flex-wrap: wrap;
    }
    .pagination a, .pagination span {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 2.8rem;
      height: 2.8rem;
      padding: 0 0.75rem;
      border-radius: 12px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      font-size: 0.9rem;
    }
    .pagination a {
      background: rgba(255,255,255,0.7);
      border: 1px solid rgba(226,232,240,0.8);
      color: #4a5568;
    }
    .pagination a:hover {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-color: transparent;
      transform: translateY(-2px);
    }
    .pagination .current {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: 1px solid transparent;
      box-shadow: 0 5px 15px rgba(102,126,234,0.4);
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center p-6">
  <div class="w-full max-w-7xl glass-effect rounded-3xl p-8 md:p-10">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-8">
      <div class="flex items-center gap-4">
        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 p-4 rounded-2xl shadow-xl">
          <i class="fas fa-user-graduate text-white text-3xl"></i>
        </div>
        <div>
          <h1 class="text-3xl md:text-4xl font-bold gradient-text">Student Records</h1>
          <p class="text-slate-600 text-sm mt-1">Manage and organize your student database</p>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
        <form method="get" action="<?=site_url('students');?>" class="relative flex w-full md:w-auto">
          <input 
            type="text" 
            name="q" 
            value="<?=html_escape($q ?? '')?>" 
            placeholder="Search students..." 
            class="pl-12 pr-4 py-3 bg-white/80 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 w-full md:w-80 shadow-sm">
          <button type="submit" class="absolute left-0 top-0 h-full px-4 text-gray-500 hover:text-purple-600">
            <i class="fas fa-search"></i>
          </button>
        </form>
        
        <a href="<?=site_url('students/create');?>"
           class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:from-purple-600 hover:to-indigo-700 transition-all">
          <i class="fas fa-plus-circle"></i>
          <span>Add New Student</span>
        </a>
      </div>
    </div>

    <!-- TABLE -->
    <div class="overflow-hidden border border-gray-200 rounded-2xl shadow-lg">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
              <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">ID</th>
              <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">First Name</th>
              <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Last Name</th>
              <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Email</th>
              <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <?php if (!empty($users)): ?>
              <?php foreach ($users as $user): ?>
              <tr class="hover:bg-indigo-50 transition">
                <td class="px-6 py-4 font-semibold text-indigo-700">#<?=html_escape($user['id']);?></td>
                <td class="px-6 py-4"><?=html_escape($user['first_name']);?></td>
                <td class="px-6 py-4"><?=html_escape($user['last_name']);?></td>
                <td class="px-6 py-4"><?=html_escape($user['email']);?></td>
                <td class="px-6 py-4 text-center space-x-3">
                  <a href="<?=site_url('students/update/'.$user['id']);?>" 
                     class="px-4 py-2 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-100">
                     <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="<?=site_url('students/delete/'.$user['id']);?>" 
                     onclick="return confirm('Are you sure you want to delete this record?');"
                     class="px-4 py-2 bg-red-50 text-red-600 border border-red-200 rounded-lg hover:bg-red-100">
                     <i class="fas fa-trash-alt"></i> Delete
                  </a>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                  No student records found.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- PAGINATION -->
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between bg-gradient-to-r from-blue-50 to-purple-50 p-5 rounded-2xl border border-blue-100">
      <div class="text-sm text-slate-600 font-medium">
        Showing page <?=html_escape($_GET['page'] ?? 1)?>
      </div>
      <div class="pagination">
        <?=$page ?? ''?>
      </div>
    </div>

    <!-- FOOTER -->
    <div class="text-center text-sm text-slate-500 pt-6 border-t border-gray-200 mt-6">
      Student Records Management System © <?=date('Y')?> — All rights reserved.
    </div>
  </div>
</body>
</html>
