TOOL.Category		= "Clockwork Tools [Tru]"
TOOL.Name			= "#Tool.text.name"
TOOL.Command		= nil
TOOL.ConfigName		= ""


if CLIENT then
	language.Add( "Tool.text.name", "Text Tool" )
	language.Add( "Tool.text.desc", "Place some fancy text. Color coming soon!" )
	language.Add( "Tool.text.0", "Primary: Add Secondary: Remove" )

end

TOOL.ClientConVar[ "text" ]		= ""
TOOL.ClientConVar[ "scale" ]		= ""


function TOOL:LeftClick( tr )



	local ply = self:GetOwner()
	if not ply:IsAdmin() then 
		return false
	end
	
	if (tr.Entity:GetClass() == "player") then return false end
	if (CLIENT) then return true end

	local usertext = self:GetClientInfo( "text" )
	local scale = self:GetClientInfo( "scale" )

	local traceLine = ply:GetEyeTraceNoCursor();
	local fScale = scale
	
	if (fScale) then
		fScale = fScale * 0.25;
	end;
	
	local data = {
		text = usertext,
		scale = fScale,
		angles = traceLine.HitNormal:Angle(),
		position = traceLine.HitPos + (traceLine.HitNormal * 1.25)
	};
	
	data.angles:RotateAroundAxis(data.angles:Forward(), 90);
	data.angles:RotateAroundAxis(data.angles:Right(), 270);
	
	Clockwork.datastream:Start(nil, "SurfaceTextAdd", data);
	
	cwSurfaceTexts.storedList[#cwSurfaceTexts.storedList + 1] = data;
	cwSurfaceTexts:SaveSurfaceTexts();
	
	Clockwork.player:Notify(ply, "You have added some surface text.");

end


function TOOL:RightClick( tr )

	local ply = self:GetOwner()
	if not ply:IsAdmin() then 
		return false
	end

	if (tr.Entity:GetClass() == "player") then return false end
	if (CLIENT) then return true end

	local position = ply:GetEyeTraceNoCursor().HitPos;
	local iRemoved = 0;
	
	for k, v in pairs(cwSurfaceTexts.storedList) do
		if (v.position:Distance(position) <= 256) then
			Clockwork.datastream:Start(nil, "SurfaceTextRemove", v.position);
				cwSurfaceTexts.storedList[k] = nil;
			iRemoved = iRemoved + 1;
		end;
	end;
	
	if (iRemoved > 0) then
		if (iRemoved == 1) then
			Clockwork.player:Notify(ply, "You have removed "..iRemoved.." surface text.");
		else
			Clockwork.player:Notify(ply, "You have removed "..iRemoved.." surface texts.");
		end;
	else
		Clockwork.player:Notify(ply, "There were no surface texts near this position.");
	end;
	
	cwSurfaceTexts:SaveSurfaceTexts();



end



function TOOL.BuildCPanel( CPanel )

	-- HEADER
	CPanel:AddControl( "Header", { Text = "#tool.texttool.name", Description	= "#tool.texttool.desc" }  )

	local CVars = {"text_text" }
	local CVars = {"text_scale" }
									 
	CPanel:AddControl( "TextBox", { Label = "#tool.doorsetownable.text",
									 MaxLenth = "50",
									 Command = "text_text" } )

	CPanel:AddControl( "Slider",  { Label	= "Scale",
			Type	= "Float",
			Min		= 1.0,
			Max		= 20,
			Command = "text_scale",
			Description = "Size of the text"}	 )
end
