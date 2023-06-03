# Punto de venta de una tienda - Proyecto Parte I
La parte uno del proyecto se enfoca en el análisis y la generación de una base de datos para el sistema de información de una tienda de abarrotes el cual se profundiza en el primer pdf. A continuación, se describen las entidades, atributos, relaciones y restricciones identificadas en el análisis:

Entidades:
Producto

Nombre del producto
Cantidad física (existencia física)
Precio lista proveedor
Precio de venta al público
Código del producto (código de barras o número de 8 dígitos)
Existencia mínima del producto
Compra

Cantidad de productos comprados
Fecha y hora de la compra
Método de pago (efectivo o tarjeta)
Número de empleado que realizó la venta
Nombre del cliente (opcional)
Empleado

Nombre completo
Dirección
Teléfono móvil
Cargo (encargado o empleado)
Número de empleado
Cliente

Nombre
Dirección
Teléfono de casa
Teléfono móvil
RFC (solo para clientes que requieren factura)
Dirección de facturación (calle, número exterior, número interior (opcional), colonia, estado, ciudad)
Proveedor

Nombre completo
Dirección
Teléfono móvil
Productos que oferta
Fecha y horario de visita al comercio
Monto máximo de compra con el proveedor
Relaciones:
Un producto puede ser comprado en una o varias compras.
Una compra está asociada a un empleado que la realizó.
Un empleado puede hacer muchas ventas.
Un cliente puede realizar varias compras.
Un proveedor puede ofertar varios productos.
Varios productos pueden ser ofertados por varios proveedores.
Restricciones:
El código del producto debe ser único.
Solo puede haber un empleado con el cargo de "encargado".
Cada empleado tiene un número único de empleado.
Solo los clientes que requieren factura deben proporcionar RFC y dirección de facturación.
Los teléfonos de casa y móviles de los clientes no pueden repetirse.

![alt text](https://github.com/bvp42/Proyecto-Base-de-Datos/blob/0601a8e7ffdc45f3779ff3e9dd09d092f2599b31/Proyecto1-BD-ModeloE-R.jpg)



# Punto de venta de una tienda - Proyecto Parte II
Este proyecto consiste en desarrollar un sistema de información de base de datos para el control de una pequeña tienda de abarrotes el cual se profundiza en el segundo pdf. El objetivo principal es aplicar los conceptos aprendidos en clase a un proyecto real. El sistema se ha desarrollado utilizando PHP y MySQL, y se ha utilizado JavaScript y jQuery para hacerlo más dinámico. A continuación se describen las diferentes funcionalidades del sistema:

Funcionalidades
1. Registro de productos
El sistema permite al dueño de la tienda registrar los productos comprados. Para ello, se deben completar los siguientes campos obligatorios:

Nombre del producto
Cantidad física (existencia física en el momento del registro)
Precio lista proveedor
Precio de venta al público
Código del producto (código de barras o número de 8 dígitos)
Existencia mínima del producto
El sistema verifica si el producto ya está registrado antes de guardarlo. En caso de existir, actualiza la cantidad física sumándole la nueva cantidad ingresada. Se muestra un mensaje indicando si el registro o la actualización se han realizado con éxito.

2. Registro de empleados
El sistema permite registrar a los empleados de la tienda. Se deben completar los siguientes campos obligatorios:

Nombre(s)
Apellido Paterno
Apellido Materno
Dirección
Teléfono móvil
Cargo (encargado o empleado)
El sistema verifica si el empleado ya está registrado y le asigna un número único en caso de ser un nuevo registro. En caso de establecer el cargo como "Encargado", se verifica que no exista otro empleado con ese rol. Si ya hay un encargado registrado, se muestra un mensaje indicando que no puede haber dos encargados. La información se almacena con el rol de empleado y se notifica este cambio.

3. Venta
El sistema permite realizar ventas en la tienda. Los campos obligatorios para registrar una venta son:

Número de empleado
Código del producto
Cantidad del producto
Para cada producto comprado, se verifica si existe el código en la base de datos. En caso de no existir, se muestra un mensaje indicando que el producto no existe. Si el producto existe, se agrega a la lista de productos vendidos en esa compra. Además, se puede agregar otro producto, se muestra el posible número de ticket, y se pueden ingresar la fecha y hora de la compra (opcional). Al finalizar la compra, se actualiza la tabla de total de venta y se descuentan los productos vendidos de la base de datos.

4. Ventana "Acerca de"
La ventana "Acerca de" muestra información sobre la empresa que desarrolló el producto, incluyendo el nombre de la empresa, la versión del software y los datos de contacto (correo y número telefónico).

![alt text](https://github.com/bvp42/Proyecto-Base-de-Datos/blob/0601a8e7ffdc45f3779ff3e9dd09d092f2599b31/reg_prod2.jpeg)
![alt text](https://github.com/bvp42/Proyecto-Base-de-Datos/blob/0601a8e7ffdc45f3779ff3e9dd09d092f2599b31/Venta.jpeg)
