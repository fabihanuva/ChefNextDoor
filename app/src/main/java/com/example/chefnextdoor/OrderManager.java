package com.example.chefnextdoor;

import java.util.ArrayList;
import java.util.List;

public class OrderManager {

    // SINGLE active order (for now)
    public static List<String> items = new ArrayList<>();
    public static int totalPrice = 0;
    public static String chefName = "";
    public static String orderStatus = "Not Placed";

    // Reset after order completes
    public static void clearOrder() {
        items.clear();
        totalPrice = 0;
        chefName = "";
        orderStatus = "Not Placed";
    }
}
