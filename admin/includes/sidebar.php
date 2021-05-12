<?php
  session_start();
  if(!isset($_SESSION['admin'])){
    header("Location: login");
  }
  $admin_id = $_SESSION['admin']['unique_id'];
  $get_pending_orders = $object->get_pending_orders('orders','status', 0, 'status', 1);
  $get_pending_order_number = $get_pending_orders != null ? count($get_pending_orders) : 0;
  $get_delivered_order_number = $object->get_number_of_rows_one_param('orders','status', 2);
?>
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #1C174C">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
    <div class="sidebar-brand-text mx-3"><img src="../assets/images/sac.png" class="img-fluid"></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Users
  </div>
  <li class="nav-item active">
    <a class="nav-link" href="manage_users">
      <i class="fas fa-user-alt"></i>
      <span>Manage Users</span>
    </a>
  </li>
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Products
  </div>
  <li class="nav-item active">
    <a class="nav-link" href="add_product">
      <i class="fas fa-paste"></i>
      <span>Add Product</span>
    </a>
  </li>
  <li class="nav-item active">
    <a class="nav-link" href="manage_products">
      <i class="fas fa-table"></i>
      <span>Manage Products</span>
    </a>
  </li>
  <hr class="sidebar-divider">

  <div class="sidebar-heading">
    Category
  </div>
  <li class="nav-item active">
    <a class="nav-link" href="add_category">
      <i class="fas fa-tasks"></i>
      <span>Add Category</span>
    </a>
  </li>
  <li class="nav-item active">
    <a class="nav-link" href="manage_categories">
      <i class="fas fa-table"></i>
      <span>Manage Categories</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Order Management</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="pending_orders">Pending Orders &nbsp;&nbsp;<small class="badge badge-primary"><?= $get_pending_order_number?></small></a>
        <a class="collapse-item" href="delivered_orders">Delivered Orders&nbsp;&nbsp; <small class="badge badge-success"><?= $get_delivered_order_number?></small></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
      <i class="fas fa-fw fa-cog"></i>
      <span>Settings</span>
    </a>
    <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="add_new_admin">Add New Admin</a>
        <a class="collapse-item" href="add_best_selling">Add Best Selling</a>
        <a class="collapse-item" href="add_hot_now">Add Hot Now</a>
        <a class="collapse-item" href="manage_best_selling">Manage Best Selling</a>
        <a class="collapse-item" href="manage_hot_now">Manage Hot Now Products</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
  <li class="nav-item active">
    <a class="nav-link" href="logout">
      <i class="fas fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>