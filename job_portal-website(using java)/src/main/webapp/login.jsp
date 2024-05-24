<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login Page</title>
<%@include file="all_component/all_css.jsp"%>
<style type="text/css">
.back-img{
background: url("img/j4.jpg");
width: 100%;
height: 85vh;
background-repeat: no-repeat;
background-size:cover;

}


</style>


</head>
<body>
	<%@include file="all_component/navbar.jsp"%>
	<div class="container-fluid back-img">
		<div class="row p-3">
			<div class="col-md-4 offset-md-4">
				<div class="card mr-4">
				<div class="card-header text-center text-white bg-custom">
				<i class="fa-solid fa-user"></i>
				<h4>Login</h4>
				</div>
				<div class="card-body"> 
				<c:if test="${not empty succMsg }">
				<h4 class="text-center text-danger">${succMsg }</h4>
				<c:remove var="succMsg"/>
				
				</c:if>
				<form action="login" method="post">
				<div class="form-group">
						<label>Enter Email</label> <input
							type="email" class="form-control" required="required" class="form-control" id="exampleInputEmail1"
							aria-describedby="emailHelp" name="email"> 
					</div>
					
					<div class="form-group">
						<label for="exampleInputPassword1">Enter Password</label> <input
							type="password" required="required" type="password" class="form-control" id="exampleInputPassword1"
							name="password">
					</div>
					
					<button type="submit" class="btn btn-primary badge-pill btn-block">Login</button>
				</form>
				
				</div>
				</div>

			</div>
		</div>

	</div>
	<%@include file="all_component/footer.jsp" %>
</body>
</html>