<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    <%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ page isELIgnored="false" %>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Post Job</title>
<%@include file="all_component/all_css.jsp"%>
</head>
<body>
<c:if test="${userobj.role ne 'admin' }">
<c:redirect url="login.jsp"></c:redirect>
</c:if>
<%@include file="all_component/navbar.jsp"%>
<div class="container p-2">
<div class="col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<div class="text-center text-success"><i class="fa-solid fa-user"></i>
   <c:if test="${not empty succMsg }">
   <div class="alert alert-success" role="alert">${succMsg}
</div>
   <c:remove var="succMsg"/>
   </c:if>

<h5>Add Job</h5>

</div>
<form action="add_job" method="post">
  <div class="form-group">
    <label >Enter Title</label>
    <input type="text" name="title" required class="form-control">
  </div>
  <div class="form-group">
    <label >Location</label>
    <select name="location" class="custom-select" id="exampleFormControlSelect1">
      <option selected>choose...</option>
      <option value="Cuddalore">Cuddalore</option>
      <option value="Chennai">Chennai</option>
      <option value="Banglore">Banglore</option>
      <option value="Delhi">Delhi</option>
      <option value="Hydrabad">Hydrabad</option>
      <option value="Odisha">Odisha</option>
      <option value="Gujurat">Gujurat</option>
      
    </select>
  </div>
  <div class="form-group col-md-4">
    <label >Category</label>
    <select  class="custom-select" id="exampleFormControlSelect2" name="category">
      <option selected>Choose...</option>
      <option value="IT">IT</option>
      <option value="Developer">Developer</option>
      <option value="Banking">Banking</option>
      <option value="Engineer">Engineer</option>
      <option value="Teacher">Teacher</option>
      
      
    </select>
  </div>
  <div class="form-group col-md-4">
    <label>Status</label>
    <select class="form-control" name="status">
      <option class="Active" value="Active">Active</option>
      <option class="Inactive" value="Inactive">Inactive</option>
      
    </select>
  </div>
  <div class="form-group">
    <label >Enter Discription</label>
    <textarea required rows="6" cols="" name="desc" class="form-control"></textarea>
  </div>
  <button class="btn btn-success">Publish job</button>
</form>

</div>
</div>
</div>
</div>


</body>
</html>