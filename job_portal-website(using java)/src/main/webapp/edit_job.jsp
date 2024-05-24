<%@page import="com.entity.Jobs"%>
<%@page import="com.DB.DBConnect"%>
<%@page import="com.dao.JobDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    <%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ page isELIgnored="false" %>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Jobs</title>
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
  
<%
int id=Integer.parseInt(request.getParameter("id"));
JobDAO dao=new JobDAO(DBConnect.getConn());
Jobs j=dao.getJobById(id);
%>
<h5>Edit Jobs</h5>

</div>
<form action="update" method="post">
<input type="hidden" value="<%=j.getId()%>" name="id">
  <div class="form-group">
    <label >Enter Title</label>
    <input type="text" name="title" required class="form-control" value="<%=j.getTitle()%>">
  </div>
  <div class="form-group">
    <label >Location</label>
    <select name="location" class="custom-select" id="exampleFormControlSelect1">
      <option value="<%=j.getLocation()%>"><%=j.getLocation() %></option>
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
      <option value="<%=j.getCategory()%>"><%=j.getCategory() %></option>
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
            <option class="Active" value=" <%=j.getStatus() %>"><%=j.getStatus() %></option>    
      <option class="Active" value="Active">Active</option>
      <option class="Inactive" value="Inactive">Inactive</option>
      
    </select>
  </div>
  <div class="form-group">
    <label >Enter Discription</label>
    <textarea required rows="6" cols="" name="desc" class="form-control"><%=j.getDescription() %></textarea>
  </div>
  <button class="btn btn-success">update job</button>
</form>

</div>
</div>
</div>
</div>


</body>
</html>