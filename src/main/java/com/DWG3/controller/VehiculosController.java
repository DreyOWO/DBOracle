/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/springframework/Controller.java to edit this template
 */
package com.DWG3.controller;

import jakarta.persistence.EntityManager;
import jakarta.persistence.ParameterMode;
import jakarta.persistence.StoredProcedureQuery;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.object.StoredProcedure;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

/**
 *
 * @author burgo
 */


@Controller
public class VehiculosController {
    
    @RequestMapping("/vehiculos")
    public String Vehiculos(Model model) {
        model.addAttribute("attribute", "value");
        return "Vehiculos";
        
    }
    @Autowired
    
    private EntityManager entitymanager;
    
    
    @PostMapping("/nuevo")
    public String nuevoVehiculo(
        @RequestParam int placa,
        @RequestParam int idCliente,
        @RequestParam String tipo,
        @RequestParam String marca,
        @RequestParam String modelo,
        @RequestParam int año) {
    
        StoredProcedureQuery query = entitymanager.createStoredProcedureQuery("NuevoVehiculo");
        query.registerStoredProcedureParameter("p_Placa", Integer.class, ParameterMode.IN);
        query.registerStoredProcedureParameter("p_Id_cliente", Integer.class, ParameterMode.IN);
        query.registerStoredProcedureParameter("p_Tipo", String.class, ParameterMode.IN);
        query.registerStoredProcedureParameter("p_Marca", String.class, ParameterMode.IN);
        query.registerStoredProcedureParameter("p_Modelo", String.class, ParameterMode.IN);
        query.registerStoredProcedureParameter("p_Año", Integer.class, ParameterMode.IN);
        
        query.setParameter("p_Placa", placa);
        query.setParameter("p_Id_cliente", idCliente);
        query.setParameter("p_Tipo", tipo);
        query.setParameter("p_Marca", marca);
        query.setParameter("p_Modelo", modelo);
        query.setParameter("p_Año", año);
        
        query.execute();
        
        
        
        return "vehiculos";
        
    }
   
}


