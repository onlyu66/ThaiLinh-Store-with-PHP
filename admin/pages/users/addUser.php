<link rel="stylesheet" href="styles/addProduct.css">

<?php
    // include_once "../../../database/config.php";
    // include_once "../../../database/dbhelper.php";
?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="font-bold text-base">Thêm người dùng</p>
                <!-- <h1 class="modal-title fs-5" id="exampleModalLabel"></h1> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="modal-body bg-stone-100">
            
                <form class="form" action="?action=users" method="post">
                <div class="item">
                    <div class="mb-3 mb3">
                        <?php
                            $sqlRole="select * from role";
                            $role=select($sqlRole,false);
                        ?>
                    <label
                        htmlFor="role"
                        class="form-label formLabel"
                    >
                        Role:
                    </label>
                    <select name="role" id="">
                        <?php
                            foreach($role as $val){
                        ?>
                        <option value="<?php echo $val['id'];?>"><?php echo $val['role'];?></option>
                        <?php
                            }
                        ?>
                    </select>
                    </div>
                    <div class="mb-3 mb3">
                    <label
                        htmlFor="username"
                        class="form-label formLabel"
                    >
                        Tên tài khoản:
                    </label>
                    <input
                        type="text"
                        class="form-control formControl"
                        name="userName"
                        value=""
                        
                    />
                    </div>
                    <?php 
                    if(isset($errors['username'])){ ?>
                    <div class="alert" style="color: red">
                        <?php echo $errors['username']?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="item">
                    <div class="mb-3 mb3">
                    <label
                        htmlFor="email"
                        class="form-label formLabel"
                    >
                        Email:
                    </label>
                    <input
                        type="email"
                        class="form-control formControl"
                        name="email"
                        value=""
                    />
                    </div>
                    <?php 
                    if(isset($errors['email'])){ ?>
                    <div class="alert" style="color: red">
                        <?php echo $errors['email']?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="item">
                    <div class="mb-3 mb3">
                    <label
                        htmlFor="password"
                        class="form-label formLabel"
                    >
                        Mật khẩu:
                    </label>
                    <input
                        type="password"
                        class="form-control formControl"
                        name="password"
                        value=""
                        
                    />
                    </div>
                    <?php 
                    if(isset($errors['password'])){ ?>
                    <div class="alert" style="color: red">
                        <?php echo $errors['password']?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="item">
                    <div class="mb-3 mb3">
                    <label
                        htmlFor="confirmPassword"
                        class="form-label formLabel"
                    >
                        Xác nhận mật khẩu:
                    </label>
                    <input
                        type="password"
                        class="form-control formControl"
                        name="confirmPassword"
                        value=""
                        
                    />
                    </div>
                    <?php 
                    if(isset($errors['confirm_password'])){ ?>
                        <div class="alert" style="color: red">
                        <?php echo $errors['confirm_password']?>
                        </div>
                    <?php
                    }
                    ?>
                    
                </div>
                <div class="text-center">
                <input
                    type="submit"
                    class="btn rounded p-2 bg-stone-200 hover:shadow hover:bg-stone-300 font-semibold"
                    name="addUserBtn"
                    value="Add User"
                />
                </div>
                </form>
            </div>
        </div>
    </div>
<script>
    // function previewImage() {
    //     var previewContainer = document.getElementById('img');
    //     previewContainer.innerHTML = ''; // Xóa các hình ảnh hiện tại
        
    //     var files = document.getElementById('uploadImage').files;


    //     for (var i = 0; i < files.length; i++) {
    //         var reader = new FileReader();

    //         reader.onload = function (e) {
    //             var img = document.createElement('img');
    //             img.src = e.target.result;
    //             img.style.maxWidth = '25%';
    //             img.style.maxHeight = '100px';
    //             previewContainer.appendChild(img);
    //         };

    //         reader.readAsDataURL(files[i]);
    //     }
    // }
    function previewImages() {
        var previewContainers = document.getElementById('imgs');
        previewContainers.innerHTML = ''; // Xóa các hình ảnh hiện tại
        
        var files = document.getElementById('uploadImages').files;


        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '25%';
                img.style.maxHeight = '100px';
                img.classList.add("p-1", "rounded-xl", "shadow-sm");
                previewContainers.appendChild(img);
            };

            reader.readAsDataURL(files[i]);
        }
    }
</script>
<script>
    function previewImage() {
        var previewContainer = document.getElementById('img');
        previewContainer.innerHTML = ''; // Xóa hình ảnh hiện tại

        var fileInput = document.getElementById('uploadImage');
        var file = fileInput.files[0]; // Chỉ lấy tệp đầu tiên

        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '25%';
                img.style.maxHeight = '100px';
                img.classList.add("p-1", "rounded-xl", "shadow-sm");
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }

</script>

