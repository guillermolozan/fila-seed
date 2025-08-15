---
description:
globs:
alwaysApply: false
---

# CRM de Alumnos — IESP Chancay (product.md)

## Descripción
Sistema CRM para gestionar el ciclo de vida del alumno (ingreso → egreso → posalumno), integrando registro académico, seguimiento, indicadores y comunicación (WhatsApp/Email). Incluye importación de notas desde REGISTRA (MINEDU), control de prácticas, estados académicos, y paneles de indicadores.

## Objetivos
- Centralizar datos del alumno y su historial académico/administrativo.
- Importar y consolidar calificaciones desde REGISTRA sin edición manual.
- Medir retención, aprobación, egreso, deserción y empleabilidad.
- Facilitar seguimiento (reclamos, encuestas, actividades) y comunicación trazable.
- Habilitar actualización de datos por el alumno vía formulario seguro.
- Proveer reportes exportables e impresión con filtros por ciclo/carrera/turno.

## Features

### 1) Gestión de Alumnos
- Registro completo con foto y datos personales; contacto familiar.  
- Campos clave: turno, fechas (registro/inicio/nacimiento), ubicación, salud (grupo sanguíneo, seguro), situación familiar, ocupación, etc.  
- Formulario autogestionado (link por WhatsApp/Email) para actualizar datos seleccionados.

### 2) Oferta Académica
- Programas: Computación e Informática, Contabilidad, Desarrollo de Sistemas de Información, Gestión Logística.  
- Turnos: Mañana/Tarde.  
- Estructura: 6 ciclos (I–VI) por carrera; cada ciclo con Unidades Didácticas (UD).  
- Docentes por UD (tabla de Docentes).

### 3) Notas e Integración REGISTRA (MINEDU)
- Importación de PDF/plantillas del sistema REGISTRA (campos espejo: institución, periodo, plan, UD, turno, programa, docente, sección; Nro, Tipo/Nro doc, alumno, nota, fecha/hora de emisión).  
- Bloqueo de edición local de notas finales importadas.

### 4) Prácticas y Empleabilidad
- Prácticas Laborales: sí/no, entidad, fechas (inicio/término).  
- Estado laboral “En lo que estudió”: empresa/institución/otros, cargo, nivel salarial (rangos).

### 5) Estados del Alumno
- Estudiando, Licencia (opciones), Retirado (con fecha y motivo), En prácticas (sincroniza con módulo de Prácticas), Culminó (con fecha), Titulándose (inscripción), Titulado (fecha).

### 6) Seguimientos (Actividades)
- Tipos: Reclamo, Reclamo resuelto, Participación extracurricular, otros.  
- Registro de comentarios y trazabilidad por alumno.  
- Encuestas por ciclo (satisfacción: docencia, infraestructura, soporte).

### 7) Indicadores (Dashboards y Filtros)
- Filtros: semestre, ciclo, carrera, turno, UD, estado.  
- Ejemplos:  
  - Retención por ciclo.  
  - Desaprobados por UD y por ciclo/semestre.  
  - Tasa de egreso; tasa de deserción (por año de ingreso/turno/carrera).  
  - Prácticas activas por carrera/turno.  
  - Índice de satisfacción; % reclamos resueltos; participación extracurricular.  
  - Posalumno: tiempo a titulación, empleabilidad al año, salario promedio, participación en educación continua.

### 8) Educación Continua (Posalumno)
- Múltiples registros por persona: tipo (Curso/Diplomado/Taller/Programa), nombre, fechas, certificado (sí/no).

### 9) Comunicación Trazable
- WhatsApp integrado (mensajes quedan en el CRM).  
- Email transaccional (Mailjet gratuito) con registro en el CRM.

### 10) Búsqueda, Exportación e Impresión
- Buscador “direlink”.  
- Filtros combinables.  
- Exportar (según permisos) e Imprimir vistas y reportes.

### 11) Seguridad y Roles
- Superadministrador: acceso total.  
- Visor: solo lectura; sin exportar.  
- Product Manager (secretaría practicante): gestiona Seguimientos, “Laborando en lo que estudió” y Educación Continua; no elimina alumnos, no mantiene tablas, no edita notas importadas.

### 12) Mantenimientos
- Tablas base (docentes, programas, UDs, catálogos).  
- Módulo de usuarios y permisos.

### 13) Roadmap / Alcances diferidos
- Historia clínica: en fase final (posterior).

---
## Métricas clave (KPIs)
- Retención por ciclo.  
- % desaprobados (por UD y por ciclo/semestre).  
- Tasa de egreso y deserción.  
- Tiempo promedio a titulación.  
- Empleabilidad al año de egreso y nivel salarial.  
- Satisfacción (encuestas), % reclamos resueltos, participación extracurricular.
