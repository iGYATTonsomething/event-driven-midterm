<?php

if (isset($_POST['type'])) {
  $type = $_POST['type'];
  $code = $_POST['post_code'];

  if ($type == "region") {
    getProvince($code);
  } elseif ($type == "province") {
    getCity($code);
  } elseif ($type == "brgy") {
    getBrgy($code);
  }
}




function getProvince($regCode)
{

  include '../config/database.php';

  $sql = "SELECT * FROM ph_province WHERE regCode = '$regCode'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
      <option value="<?= $row['provCode'] ?>"><?= $row['provDesc'] ?></option>
<?php

    }
  } else {
    echo "0 results";
  }
  $conn->close();
}

function getCity($provCode) {
  include '../config/database.php';

  $sql = "SELECT * FROM ph_citymun WHERE provCode = '$provCode'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      ?>
        <option value="<?= $row['citymunCode'] ?>"><?= $row['citymunDesc'] ?></option>
      <?php
    }
  } else {
    echo "0 results";
  }
  $conn->close();
}

function getBrgy($citymunCode) {
  include '../config/database.php';

  $sql = "SELECT * FROM ph_brgy WHERE citymunCode = '$citymunCode'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      ?>
        <option value="<?= $row['brgyCode'] ?>"><?= $row['brgyDesc'] ?></option>
      <?php
    }
  } else {
    echo "0 results";
  }
  $conn->close();
}