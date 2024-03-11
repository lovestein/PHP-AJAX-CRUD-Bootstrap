<?php
include './includes/header.php';
?>

<!-- Add Student Modal -->
<div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- This is the id (saveStudent) that will be passed to the jQuery function -->
            <form id="saveStudent">
                <div class="modal-body">
                    <!-- Form Alert Message -->
                    <div id="formAlertAddStudent" class="toast w-100 my-2">
                        <div class="d-flex">
                            <div id="formAlertMessageAddStudent" class="toast-body"></div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    <!-- Input Forms -->
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Course</label>
                        <input type="text" id="course" name="course" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- This is the id (saveStudent) that will be passed to the jQuery function -->
            <form id="updateStudent">
                <div class="modal-body">
                    <!-- Form Alert Message -->
                    <div id="formAlertUpdateStudent" class="toast w-100 my-2">
                        <div class="d-flex">
                            <div id="formAlertMessageUpdateStudent" class="toast-body"></div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    <!-- Hiddent Student id -->
                    <input type="hidden" name="student_id" id="student_id">
                    <!-- Input Forms -->
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="editName" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="text" name="email" id="editEmail" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="editPhone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Course</label>
                        <input type="text" name="course" id="editCourse" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Student Modal -->
<div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">View Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- This is the id (saveStudent) that will be passed to the jQuery function -->
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_name" class="fw-bold"></p>
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <p id="view_email" class="fw-bold"></p>
                </div>

                <div class="mb-3">
                    <label for="">Phone</label>
                    <p id="view_phone" class="fw-bold"></p>
                </div>

                <div class="mb-3">
                    <label for="">Course</label>
                    <p id="view_course" class="fw-bold"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Table Content -->
<div class="container-lg">
    <div class="row">
        <div class="col-md-12 pt-5">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Advance Database System - CRUD Operations
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#studentAddModal">
                            Add Student
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM students";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $student) {
                            ?>
                                    <tr>
                                        <td><?= $student['id']; ?></td>
                                        <td><?= $student['name']; ?></td>
                                        <td><?= $student['email']; ?></td>
                                        <td><?= $student['phone']; ?></td>
                                        <td><?= $student['course']; ?></td>
                                        <td>
                                            <button type="button" value="<?= $student['id']; ?>" id="viewStudentButton" class="btn btn-info">View</button>
                                            <button type="button" value="<?= $student['id']; ?>" id="editStudentButton" class="btn btn-success">Edit</button>
                                            <button type="button" value="<?= $student['id']; ?>" id="deleteStudentButton" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
include './includes/footer.php';
?>