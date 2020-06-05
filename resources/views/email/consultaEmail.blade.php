<!DOCTYPE html>
<html>
<head>
	<title>Nueva Consulta</title>
</head>
<body>
	<p>Se ha realizado una nueva consulta!</p>
	<ul>
		<li>
			<strong>Nombre:</strong>
			{{$name}}
		</li>
		<li>
			<strong>E-Mail:</strong>
			{{$email}}
		</li>
		
        <li>
            <strong>Mensaje:</strong>
            {{htmlspecialchars($message)}}
        </li>
        
		
	</ul>
	
	<hr>
	
</body>
</html>