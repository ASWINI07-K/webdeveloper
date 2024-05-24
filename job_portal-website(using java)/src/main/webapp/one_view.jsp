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
<title>View Jobs</title>
<%@include file="all_component/all_css.jsp"%>
</head>
<body>
 <c:if test="${empty userobj}">
   <c:redirect url="login.jsp"></c:redirect>
   </c:if>
<%--<c:if test="${userobj.role ne 'admin' }">
<c:redirect url="login.jsp"></c:redirect>
</c:if> --%>
<%@include file="all_component/navbar.jsp"%>
<div class="container">
<div class="row">
<div class="col-md-12">
<h5 class="text-center text-primary"></h5>

 <c:if test="${not empty succMsg }">
   <div class="alert alert-success" role="alert">${succMsg}
</div>
   <c:remove var="succMsg"/>
   </c:if>

<%
int id=Integer.parseInt(request.getParameter("id"));
JobDAO dao=new JobDAO(DBConnect.getConn());
Jobs j=dao.getJobById(id);

%>

	

<div class="card mt-2">
<div class="card-body">
<div class="text-center text-primary">
<i class="fa-regular fa-clipboard"></i>
</div>
<h6><%=j.getTitle() %></h6>
<p><%=j.getDescription() %></p><br>
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
<h6>Publish Date:<%=j.getPdate().toString() %></h6>

</div>
</div>
</div>









</div>
</div>

</div>


</body>
</html>