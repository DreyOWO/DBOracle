/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package com.DWG3.service;

import com.DWG3.domain.Detalles;
import java.util.List;

/**
 *
 * @author HP PROBOOK
 */
public interface DetalleService {
    public List<Detalles> obtenerDetallesFactura(int idMoneda);
}
