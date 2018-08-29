<body>
  <div class="container" style="padding-top: 10vh; padding-bottom: 15vh">
        <p style="font-size: 27px; text-align: center; padding-top: 50px;">Dasar Hukum</p>
            <table class="table" cellspacing="0">
                          <thead class="mdb-color darken-3 white-text">
                            <tr>
                              <th scope="col">No
                                <i aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" scope="col">Hukum
                                <i aria-hidden="true"></i>
                              </th>
                              <th class="th-sm" sscope="col">Edit
                                <i aria-hidden="true"></i>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $counter = 1;
                            foreach ($hukum as $row) {
                echo "
                <tr>
                              <td>".$counter."</td>
                              <td>".$row->hukum."</td>
                              <td>
                                <span class='table-remove'><a href='".base_url("home/edit_hukum_page/$row->id")."'><button type='button'  class='btn btn-warning btn-sm my-0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>
                              </td>
                            </tr>
                            ";
              $counter++;}
                             ?>
                      </tbody>
                    </table>
  </div>
</body>
<script>
$(document).ready(function () {
  $('#pejabat').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>
</html>

