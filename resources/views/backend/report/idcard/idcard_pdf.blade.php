<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>


<table id="customers">
    <tr>
        <td>
          <?php $image_path ='/upload/easyschool.png'; ?>
          <img src="{{public_path() . $image_path}}" width="200px" height="100px" alt="">
        </td>
        <td><h2>Easy School ERP</h2>
        <p>School Address: UA, Severodonetsk</p>
        <p>Phone: +380668022598</p>
        <p>Email: feysaball123@gmail.com</p>
        <p><b>Student ID Card</b></p></td>
    </tr>
    </table>

@foreach ($allData as $value)
<br>
<table id="customers">
  <tr>
      <td rowspan="3" style="text-align:center">
          <img style="border: 1px solid #ffffff;"
        src="{{ (!empty($value['student']['image'])) ? url('upload/student_images/'.$value['student']['image']) : url('upload/no_image.jpg') }}" style="height: 150px;" alt="User Avatar">
    </td>
      <td colspan="3" style="text-align: center">Student ID Card</td>
  </tr>

  <tr>
    <td>Name: {{$value['student']['name']}}</td>
    <td>Year: {{$value['student_year']['name']}}</td>
    <td>Class: {{$value['student_class']['name']}}</td>
</tr>

<tr>
    <td>Role: {{$value->roll}}</td>
    <td>ID №: {{$value['student']['id_no']}}</td>
    <td>Mobile: {{$value['student']['mobile']}}</td>
</tr>

</table>
@endforeach

<br>
<i style="font-size:12px; float: right;">Print Data : {{ date("d M Y") }}</i>

    <hr style="border:dashed 2px; width:95%;color:#000000; margin-bottom:50px;">

</body>
</html>


