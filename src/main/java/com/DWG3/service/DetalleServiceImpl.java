/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.DWG3.service;

import com.DWG3.dao.DetalleDao;
import com.DWG3.domain.Detalles;
import org.springframework.transaction.annotation.Transactional;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.*;


@Service
public class DetalleServiceImpl implements DetalleService{
    @Autowired
    DetalleDao detalleRepository;
    
    @Override
    @Transactional(readOnly = false)
     public List<Detalles> obtenerDetallesFactura(int idMoneda) {
        return (List<Detalles>) detalleRepository.usp_lista_detalles_factura(idMoneda);
    }
    
    
    
}
