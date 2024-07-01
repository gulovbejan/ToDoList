<?php
require_once "../controller/main.php";

if (!isset($_SESSION['userLogIn'])) {
  header("Location: ./login_view.php");
  exit;
}

require_once "../model/todolist.php";
require_once "../model/dataAccess.php";
?>

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
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../controller/logout.php">
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

      <div class="sign-out">
      <li class="nav-item">
        <a class="nav-link" href="../controller/logout.php">
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
                <div class="table-responsive">
                  <form action="../controller/main.php" method="post">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                      Add new task
                    </button>
                  </form>
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th>Task Description</th>
                        <th data-type="date" data-format="DD/MM/YYYY">Date</th>
                        <th data-type="time">Start Time</th> 
                        <th data-type="time">End Time</th> 
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach (DataAccess::getAllList() as $todolist): ?>
                    <tr>
                        <td><?= htmlspecialchars($todolist->task) ?></td>
                        <td><?= (new DateTime($todolist->date))->format('d-m-Y');?></td>
                        <td><?= (new DateTime($todolist->start_time))->format('H:i'); ?></td>
                        <td><?= (new DateTime($todolist->end_time))->format('H:i'); ?></td>
                        <td><?= htmlspecialchars($todolist->priority); ?></td>
                        <td><?= htmlspecialchars($todolist->status); ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $todolist->id ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?= $todolist->id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $todolist->id ?>" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?= $todolist->id ?>">Edit Task</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <form id="editTaskForm<?= $todolist->id ?>" action="../controller/edit.php" method="post">
                                      <input type="hidden" name="id" value="<?= $todolist->id ?>">
                                      <div class="mb-3">
                                        <label for="task" class="form-label">Task Description</label>
                                        <input type="text" class="form-control" id="task" name="task" value="<?= htmlspecialchars($todolist->task) ?>" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" value="<?= $todolist->date ?>" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="start_time" class="form-label">Start Time</label>
                                        <input type="time" class="form-control" id="start_time" name="start_time" value="<?= $todolist->start_time ?>" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="end_time" class="form-label">End Time</label>
                                        <input type="time" class="form-control" id="end_time" name="end_time" value="<?= $todolist->end_time ?>" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="priority" class="form-label">Priority</label>
                                        <select class="form-select" id="priority" name="priority" required>
                                          <option value="Low-Priority" <?= $todolist->priority == "Low-Priority" ? 'selected' : '' ?>>Low Priority</option>
                                          <option value="Normal-Priority" <?= $todolist->priority == "Normal-Priority" ? 'selected' : '' ?>>Normal Priority</option>
                                          <option value="High-Priority" <?= $todolist->priority == "High-Priority" ? 'selected' : '' ?>>High Priority</option>
                                        </select>
                                      </div>
                                      <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status" required>
                                          <option value="Not Started" <?= $todolist->status == "Not Started" ? 'selected' : '' ?>>Not Started</option>
                                          <option value="In Progress" <?= $todolist->status == "In Progress" ? 'selected' : '' ?>>In Progress</option>
                                          <option value="Completed" <?= $todolist->status == "Completed" ? 'selected' : '' ?>>Completed</option>
                                        </select>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div><!-- End Edit Modal -->
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary delete-task-btn" 
                                    data-task="<?= htmlspecialchars($todolist->task) ?>" 
                                    data-date="<?= htmlspecialchars($todolist->date) ?>"
                                    data-start-time="<?= htmlspecialchars($todolist->start_time) ?>"
                                    data-end-time="<?= htmlspecialchars($todolist->end_time) ?>"
                                    data-priority="<?= htmlspecialchars($todolist->priority) ?>"
                                    data-status="<?= htmlspecialchars($todolist->status) ?>">
                              <i class="bi bi-trash"></i>
                            </button>
                        </td>
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

    <!-- ADD Modal structure --> 
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form to add new task -->
            <form id="addTaskForm" action="../controller/main.php" method="post">
              <div class="mb-3">
                <label for="task" class="form-label">Task Description</label>
                <input type="text" class="form-control" id="task" name="task" placeholder="Enter task description" required>
              </div>
              <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
              </div>
              <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" required>
              </div>
              <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" required>
              </div>
              
              <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select class="form-select" id="priority" name="priority" required>
                  <option value="Low-Priority">Low Priority</option>
                  <option value="Normal-Priority">Normal Priority</option>
                  <option value="High-Priority">High Priority</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                  <option value="Not Started">Not Started</option>
                  <option value="In Progress">In Progress</option>
                  <option value="Completed">Completed</option>
                </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" form="addTaskForm">Save Task</button>
          </div>
        </form>
        </div>
      </div>
    </div><!-- End ADD Modal -->

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this task?
          </div>
          <div class="modal-footer">
            <form id="deleteTaskForm" action="../controller/main.php" method="post">
              <input type="hidden" name="task" id="deleteTask">
              <input type="hidden" name="date" id="deleteDate">
              <input type="hidden" name="start_time" id="deleteStartTime">
              <input type="hidden" name="end_time" id="deleteEndTime">
              <input type="hidden" name="priority" id="deletePriority">
              <input type="hidden" name="status" id="deleteStatus">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger" name="delete_task">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>



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

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

  <!-- DataTables Buttons JS -->
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
