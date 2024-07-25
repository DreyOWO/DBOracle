/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.DWG3.service;

import com.DWG3.dao.ClienteDao;
import com.DWG3.domain.Cliente;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.transaction.annotation.Transactional;


public class ClienteServiceImpl implements ClienteService {
    @Autowired
    ClienteDao clienteRepository;

    @Override
    public Cliente guardarCliente(Cliente model) {
        try{
            clienteRepository.save(model);
//            model.setResult("success");
            return model;
        }
        catch(Exception ex){
//            model.setResult("failed: " + ex);
            return model;
        }
    }
    
}
