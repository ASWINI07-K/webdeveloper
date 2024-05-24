     <%@page import="com.entity.Jobs"%>
<%@page import="java.util.List"%>
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
<title>user:View Jobs</title>
<%@include file="all_component/all_css.jsp"%>
</head>
<body>
 <c:if test="${empty userobj}">
   <c:redirect url="login.jsp"></c:redirect>
   </c:if>

<%@include file="all_component/navbar.jsp"%>
<div class="container">
<div class="row">
<div class="col-md-12">
<h5 class="text-center text-primary">All Jobs</h5>

<c:if test="${not empty succMsg }">
<h4 clas="text-center text-danger">${succMsg }</h4>
<c:remove var="succMsg"/>

</c:if>

 
   <form action="more_view.jsp" class="form-inline" method="get">
  
  <div class="form-group col-md-5 mt-1">
    <h5 >Location</h5>
    </div>
     <div class="form-group col-md-4 mt-1">
     <h5>Category</h5>
    
    </div>
   
    
    <div class="form-group col-md-5">
    
    <select name="loc" class="custom-select" id="exampleFormControlSelect1">
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
    <select  class="custom-select" id="exampleFormControlSelect2" name="cat">
      <option value="ca" selected>Choose...</option>
      <option value="IT">IT</option>
      <option value="Developer">Developer</option>
      <option value="Banking">Banking</option>
      <option value="Engineer">Engineer</option>
      <option value="Teacher">Teacher</option>
      
      
    </select>
    </div>
    <button class="btn btn-success" value="submit">submit</button>
  
  
  </form>
  </div>
  </div>
   

<%JobDAO dao=new JobDAO(DBConnect.getConn());
List<Jobs> list=dao.getAllJobsForUser();
for(Jobs j:list)
{%>
	
	

<div class="card mt-2">
<div class="card-body">
<div class="text-center text-primary">
<i class="fa-regular fa-clipboard"></i>
</div>
<h6><%=j.getTitle() %></h6>
<%
if(j.getDescription().length()>0&& j.getDescription().length()<120){
	%>
	<p><%=j.getDescription() %></p>
	<% 
}else{
%>
<p><%=j.getDescription().substring(0,120) %>...</p>
<%
}
%>



<br>
<div class="form-row">
<div class="form-group col-md-3">
<input type="text" class="form-control form-control-sm" value="location:<%=j.getLocation() %>" readonly>
</div>

<div class="form-group col-md-3">
<input type="text" class="form-control form-control-sm" value="category:<%=j.getCategory() %>" readonly>
</div>
<div class="form-group col-md-3">
<input type="text" class="form-control form-control-sm" value="status:<%=j.getStatus() %>" readonly>
</div>



</div>
<h6>Publish Date:<%=j.getPdate() %></h6>
<div class="text-center">
<a href="one_view.jsp?id=<%=j.getId() %>" class="btn btn-sm bg-success text-white">view more</a>

</div>
</div>
</div>
<% }
%>







</div>
</div>

</div>


</body>
</html>