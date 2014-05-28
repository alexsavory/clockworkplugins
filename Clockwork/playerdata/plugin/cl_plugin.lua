Clockwork.datastream:Hook("PlayerData", function(data)
	if (IsValid( data[1] )) then
		if (Schema.dataPanel and Schema.dataPanel:IsValid()) then
			Schema.dataPanel:Close();
			Schema.dataPanel:Remove();
		end;
		
		Schema.dataPanel = vgui.Create("cwplayerdata");
		Schema.dataPanel:Populate(data[1], data[2] or "");
		Schema.dataPanel:MakePopup();
		
		gui.EnableScreenClicker(true);
	end;
end);