function exchangeCurrencies(moneyamount, moneycurr, changecurr, currencyrate, usdtoaf, usdtopkr, usdtoirr, aftousd, aftopkr, aftoirr, pkrtousd, pkrtoaf, pkrtoirr, irrtousd, irrtoaf, irrtopkr){
	changedmoney=moneyamount;
	
	if(moneycurr=="دالر" && changecurr=="کالدار"){//finished
	
	return changedmoney=moneyamount*usdtopkr;
		
	}else if(moneycurr=="دالر" && changecurr=="تومان"){//finished
	
	return changedmoney=moneyamount*usdtoirr;
	
	}else if(moneycurr=="کالدار" && changecurr=="دالر"){//finished
	
	return changedmoney=moneyamount*pkrtousd;
	
	}else if(moneycurr=="کالدار" && changecurr=="تومان"){//finished
	
		return changedmoney=moneyamount*pkrtoirr);

	}else if(moneycurr=="تومان" && changecurr=="کالدار"){//finished
	
	return changedmoney=moneyamount*irrtopkr;
	
	}else if(moneycurr=="تومان" && changecurr=="دالر"){//finished
	
	return changedmoney=moneyamount*irrtousd;
	
	}else if(moneycurr=="افغانی" && changecurr=="دالر"){//finished
	
	return chagnedmoney=moneyamount*aftousd;
	
	}else if(moneycurr=="افغانی" && changecurr=="تومان"){//finished
	
	return changedmoney=aftoirr*moneyamount;
	
	}else if(moneycurr=="افغانی" && changecurr=="کالدار"){//finished
	
	return changedmoney=aftopkr*moneyamount;
	
	}else if(moneycurr=="دالر" && changecurr=="افغانی"){//finished
	
	return changedmoney=moneyamount*usdtoaf;
	
	}else if(moneycurr=="کالدار" && changecurr=="افغانی"){//finished
	
	return changedmoney=moneyamount*pkrtoaf;
	
	}else if(moneycurr=="تومان" && changecurr=="افغانی"){//finished
	
	return changedmoney=moneyamount*irrtoaf;
	
	}
	return changedmoney;


}

function showcurrencies(){
	usdtoaf=document.getElementById("curr1").value;
	caltoaf=document.getElementById("curr2").value;
	iratoaf=document.getElementById("curr3").value;
	usdtocal=((1000*usdtoaf)/caltoaf);
	document.getElementById("usdtocal").value=usdtocal;
	usdtoir=((1000*usdtoaf)/iratoaf);
	document.getElementById("usdtoir").value=usdtoir;
	caltousd=(caltoaf/(usdtoaf*1000));
	document.getElementById("caltousd").value=caltousd;
	caltoir=((1000*caltoaf)/(iratoaf*1000));
	document.getElementById("caltoir").value=caltoir;
	irtocal=((1000*iratoaf)/(caltoaf*1000));
	document.getElementById("irtocal").value=irtocal;
	irtousd=(iratoaf/(usdtoaf*1000));
	document.getElementById("irtousd").value=irtousd;
	aftousd=(moneyamount/usdtoaf);
	document.getElementById("aftousd").value=aftousd;
	aftoir=(1000/iratoaf);
	document.getElementById("aftoir").value=aftoir;
	aftocal=(1000/caltoaf);
	document.getElementById("aftocal").value=aftocal;
	usdtoaf=usdtoaf;
	document.getElementById("usdtoaf").value=usdtoaf;
	caltoaf=(caltoaf);
	document.getElementById("caltoaf").value=caltoaf;
	irtoaf=(iratoaf);
	document.getElementById("irtoaf").value=irtoaf;
	
		
}