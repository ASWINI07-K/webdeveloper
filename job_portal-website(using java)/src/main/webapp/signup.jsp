<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
	 <%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
	<%@page isELIgnored="false" %>
	
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Signup Page</title>
<%@include file="all_component/all_css.jsp"%>
<style type="text/css">
.back-img{
background: url("img/j3.jpg");
width: 100%;
height: 84vh;
background-repeat: no-repeat;
background-size:cover;


</style>
</head>
<body>
	<%@include file="all_component/navbar.jsp"%>
	<div class="container-fluid back-img">
		<div class="row p-3">
			<div class="col-md-4 offset-md-4">
				<div class="card mr-2">
					<div class="card-header text-center text-white bg-custom">
						<i class="fa-solid fa-user"></i>
						<h4>Register</h4>
					</div>
					<c:if test="${not empty succMsg }">
					<h4 class="text-center text-success">${succMsg}</h4>
					<c:remove var="succMsg"/>
					</c:if>
					
					<div class="card-body">
						<form action="add_user" method="post">
							<div class="form-group">
								<label for=>Enter Full Name</label> <input
									type="text" required="required" class="form-control" id="exampleInputEmail1"
									aria-describedby="emailHelp" name="name">
								
							</div>
							<div class="form-group">
								<label>Enter Qualification</label> <input
									type="text" required="required" class="form-control" id="exampleInputPassword1"
									name="qua">
							</div>
							<div class="form-group">
								<label>Enter Email</label> <input
									type="email" required="required" class="form-control" id="exampleInputPassword1"
									name="email">
							</div>
							<div class="form-group">
						<label for="exampleInputPassword1">Enter Password</label> <input
							type="password" required="required" type="password" class="form-control" id="exampleInputPassword1"
							name="ps">
					</div>
							
							<button type="submit" class="btn btn-primary badage-pill btn-block">Register</button>
						</form>
					</div>
				</div>

			</div>
		</div>

	</div>
	<%@include file="all_component/footer.jsp"%>

</body>
</html>