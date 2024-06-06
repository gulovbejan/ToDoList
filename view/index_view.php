
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - To Do List</title> 
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index_view.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="Logotype">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link " href="./index_view.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="./calendar_view.php">
          <i class="bi-calendar"></i>
          <span>Calendar</span>
        </a>
      </li><!-- End Calendar Page Nav -->

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="bi-printer"></i>
          <span>Print</span>
        </a>
      </li><!-- End Print Nav -->

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="bi-box-arrow-up-right"></i>
          <span>Export</span>
        </a>
      </li><!-- End Export Nav -->

      <li class="nav-item">
        <a class="nav-link" href="./login_view.php">
          <i class="bi-box-arrow-left"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Nav -->
      

      <div class="sign-out">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="bi bi-box-arrow-right"></i>
          <span>Sign Out</span>
        </a>
      </li><!-- End Sign Out Nav -->
      </div>
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./index_view.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
            </div><!-- End Page Title -->
          </div><!-- End Left side columns -->
  
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">To Do List:</h5>
  
                <!-- Add new task button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                  Add new task
                </button>
            
  
                <div class="table-responsive">
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th>Task Description</th>
                        <th data-type="date" data-format="DD/MM/YYYY">Date</th>
                        <th data-type="time">Start Time</th> 
                        <th data-type="time">End Time</th> 
                        <th>Priority</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach (DataAccess::getAllList() as $todolist): ?>
                    <tr>
                        <td><?= htmlspecialchars($todolist->task) ?></td>
                        <td><?= htmlspecialchars($todolist->date) ?></td>
                        <td><?= htmlspecialchars($todolist->start_time) ?></td>
                        <td><?= htmlspecialchars($todolist->end_time) ?></td>
                        <td><?= htmlspecialchars($todolist->priority) ?></td>
                        <td><?= htmlspecialchars($todolist->status) ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table><!-- End Table with stripped rows -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Section -->

    <!-- Modal structure -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form to add new task -->
            <form id="addTaskForm">
              <div class="mb-3">
                <label for="taskDescription" class="form-label">Task Description</label>
                <input type="text" class="form-control" id="taskDescription" placeholder="Enter task description" required>
              </div>
              <div class="mb-3">
                <label for="taskDate" class="form-label">Date</label>
                <input type="datetime-local" class="form-control" id="taskDate" required>
              </div>
              <div class="mb-3">
                <label for="taskStartTime" class="form-label">Start Time</label>
                <input type="time" class="form-control" id="taskStartTime" required>
              </div>
              <div class="mb-3">
                <label for="taskEndTime" class="form-label">End Time</label>
                <input type="time" class="form-control" id="taskEndTime" required>
              </div>
              
              <div class="mb-3">
                <label for="taskPriority" class="form-label">Priority</label>
                <select class="form-select" id="taskPriority" required>
                  <option value="Low-Priority">Low Priority</option>
                  <option value="Normal-Priority">Normal Priority</option>
                  <option value="High-Priority">High Priority</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="taskStatus" class="form-label">Status</label>
                <select class="form-select" id="taskStatus" required>
                  <option value="Not Started">Not Started</option>
                  <option value="In Progress">In Progress</option>
                  <option value="Completed">Completed</option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" form="addTaskForm">Save Task</button>
          </div>
        </div>
      </div>
    </div><!-- End Modal -->

  </main><!-- End Main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>To-Do</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
