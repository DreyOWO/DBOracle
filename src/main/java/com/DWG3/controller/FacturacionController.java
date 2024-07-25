/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/springframework/Controller.java to edit this template
 */
package com.DWG3.controller;

import com.DWG3.domain.Cliente;
import com.DWG3.domain.Detalles;
import com.DWG3.service.ClienteService;
import com.DWG3.service.ClienteServiceImpl;
import com.DWG3.service.DetalleService;
import com.DWG3.service.DetalleServiceImpl;
import java.util.List;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;


@Slf4j
@Controller
public class FacturacionController {
    
    @Autowired
    DetalleServiceImpl svc;
    
    @Autowired
    ClienteServiceImpl clienteBL;
    
    @RequestMapping("/solicitarcita")
    public String facturar(Model model) {
        model.addAttribute("attribute", "value");
        return "SolicitarCita";
    }
}
