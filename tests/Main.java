/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package infijaaprefija;

import java.io.*;
import java.util.Arrays;
import java.util.List;

/**
 *
 * @author jalvarez
 */
public class Main
{
    char ordenOperadores[] = {'*', '/', '+', '-'};
    
    public Main()
    {
        //String ecuacion = leerTeclado("Inserte su ecuacion : ");
        
        //System.out.println("Resultado= "+agruparEnParentesis(ecuacion));
        System.out.println("caracter= "+"1*(7u+(e-(e+56)*4)+8)*".charAt(21));
        //System.out.println("miembroIzq= "+getMienbroAnterior("1*(7ue4)*", 8));
        
        System.out.println("miembro der= "+getMienbroAnterior("1*(7u+(e-(e+56)*4)+8)*", 21));
        
        
        //System.out.println("Busqueda= "+Arrays.binarySearch(ordenOperadores, '7'));
        
        
        /*
         * 1) Agrupar todas las operaciones de menor precedencia (* / + -) dentro parentesis
         * 2) Por cada parentesis mayor quitar su operador (recursivamente)
         * 
         * System.out.println();
        */
    }
    
    public String agruparEnParentesis(String ecuacion)
    {
        // Para cada operador agrupamos en parentesis
        for(int ind=0; ind < ordenOperadores.length; ind++)
        {
            char operador = ordenOperadores[ind];
            
            // Recorremos toda la cadena de la ecuacion
            for(int ind2=0; ind2 < ecuacion.length(); ind2++)
            {
                char caracter = ecuacion.charAt(ind2);
                // Si el caracter es igual al operador
                if(operador == caracter)
                {
                    // Examinamos si a los lados del operador existen numero
                    // Sino examinamos si a los lados del operador existen parentesis
                    
                    
                    String anterior = getMienbroAnterior(ecuacion, ind2);
                    
                    System.out.println("anterior ->"+anterior);
                    
                }
                //System.out.println("Char ->"+ecuacion.charAt(ind2));
            }
        }
        
        
        return ecuacion;
    }
    
    public String getMienbroAnterior(String ecuacion, int pos)
    {
        String miembro = "";
        boolean miembroEnParentesis = false;
        int contParentesis = 0;
        
        for(int i=pos-1; i >= 0; i--)
        {
            char c = ecuacion.charAt(i);
            
            if(c == ')' && miembroEnParentesis == false)
                miembroEnParentesis = true;
            else
            {
                // Si el miembro es todo un parentesis
                if(miembroEnParentesis)
                {
                    if(c != '(' || contParentesis > 0)
                        miembro = c+""+miembro;
                    else if(c == '(' && contParentesis <= 0)
                        break;
                    
                    if(c == ')')
                        contParentesis ++;
                    
                    if(c == '(')
                        contParentesis --;

                }
                else
                {
                    if(!estaEnArr(ordenOperadores, c))
                        miembro = c+""+miembro;
                    else
                        break;
                }
            }
        }
        
        return miembro;
    }
    
    public String getMienbroSiguiente(String ecuacion, int pos)
    {
        String miembro = "";
        boolean miembroEnParentesis = false;
        int contParentesis = 0;
        
        for(int i=pos+1; i < ecuacion.length(); i++)
        {
            char c = ecuacion.charAt(i);
            
            if(c == '(' && miembroEnParentesis == false)
                miembroEnParentesis = true;
            else
            {
                // Si el miembro es todo un parentesis
                if(miembroEnParentesis)
                {
                    if(c != ')' || contParentesis > 0)
                        miembro += ""+c;
                    else if(c == ')' && contParentesis <= 0)
                        break;
                    
                    if(c == '(')
                        contParentesis ++;
                    
                    if(c == ')')
                        contParentesis --;

                }
                else
                {
                    if(!estaEnArr(ordenOperadores, c))
                        miembro += ""+c;
                    else
                        break;
                }
            }
        }
        
        return miembro;
    }
    
    public boolean estaEnArr(char[] arreglo , char c)
    {
        boolean respuesta = false;
        
        for(int i=0; i< arreglo.length; i++)
        {
            if(c == arreglo[i])
            {
                respuesta = true;
                break;
            }
        }
        
        return respuesta;
    }
    
    public String leerTeclado(String mensaje)
    {
        String dato = "";

        InputStreamReader isr = new InputStreamReader(System.in);
        BufferedReader br = new BufferedReader (isr);

        System.out.print(mensaje);

        try
        {
            dato = br.readLine();
        }
        catch (Exception e)
        {
            e.printStackTrace();
        }
        return dato;
    }

    public static void main(String[] staler)
    {
    	new Main();
    }
}
