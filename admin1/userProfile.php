<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <article class="card-body">
                    <form method="post">
                        <div class="form-group text-center" >
                            <div><?php if(isset($faild_err)) echo $faild_err; ?></div>
                            <img src="image/user.png" onclick="triggerClick()" alt="profile" id="profileDisplay" style="display:block;width:150px; height:150px; margin:10px auto;border-radius:50%;">
                            <input type='file' name='profileImage' onchange="displayImage(this)" id="profileImage" style="display: none;"/>
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label>First Name </label>
                                <input type="text" name="fname" class="form-control" placeholder="" value="<?php  echo $Fname; ?>">
                            </div> <!-- form-group end.// -->
                            <div class="col form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" placeholder="" value="<?php  echo $lname; ?>">
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row end.// -->
                        <div class="form-row">
                            <div class="col form-group">
                                <label>Email </label>
                                <input type="text" name="fname" class="form-control" placeholder="" value="<?php  echo $email; ?>">
                            </div> <!-- form-group end.// -->
                            <div class="col form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" placeholder="" value="<?php  echo $uName; ?>">
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row end.// -->
                        <div class="form-group">
                            <label>Reg Number</label>
                            <input type="text" class="form-control" placeholder="" value="<?php  echo $regNum; ?>">
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="option1">
                                <span class="form-check-label"> Male </span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="option2">
                                <span class="form-check-label"> Female</span>
                            </label>
                        </div> <!-- form-group end.// -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Facultie</label>
                                <select id="inputState" class="form-control">
                                    <option> Choose...</option>
                                    <option>IT</option>
                                    <option>SE</option>
                                    <option>IM</option>
                                </select>
                            </div> <!-- form-group end.// -->
                            <div class="form-group col-md-6">
                                <label>Year</label>
                                <select id="inputState" class="form-control">
                                    <option> Choose...</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option selected="">3 </option>
                                    <option>4</option>
                                </select>
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row.// -->
                    </form>
                </article> <!-- card-body end .// -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
