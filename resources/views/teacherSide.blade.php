
<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Admin Panel
                </a>
            </li>
            <li>
                <a href="/Teacher">Teacher</a>
            </li>
            <li>
                <a href="/Attendance/Class">Attendance Class</a>
            </li>
            <li>
                <a href="/Attendance/Student">Student attendance</a>
            </li>
            <li>
                <a href="/Attendance/Mark">Mark Attendance</a>
            </li>
            <li>
                <a href="/courses">Course Management</a>
            </li>

        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">


                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>




