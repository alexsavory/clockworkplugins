TOOL.Category		= "Clockwork Tools [Tru]"
TOOL.Name			= "#Tool.doorsetownable.name"
TOOL.Command		= nil
TOOL.ConfigName		= ""


if CLIENT then
	language.Add( "Tool.doorsetownable.name", "Door Set Ownable" )
	language.Add( "Tool.doorsetownable.desc", "Make a door ownable." )
	language.Add( "Tool.doorsetownable.0", "Primary: Set Ownable" )
	language.Add( "Tool.doorsetownable.text", "The Description" )

end


TOOL.ClientConVar[ "description" ]		= ""



function TOOL:LeftClick( tr )
local Clockwork = Clockwork
	
	local description		= self:GetClientInfo( "description" )


	if (tr.Entity:GetClass() == "player") then return false end
	if (CLIENT) then return true end

	local Ply = self:GetOwner()
	local door = Ply:GetEyeTraceNoCursor().Entity;


if not Ply:IsAdmin() then 
	return false
end
	if (IsValid(door) and Clockwork.entity:IsDoor(door)) then
		local data = {
			customName = true,
			position = door:GetPos(),
			entity = door,
			name = description or self:GetClientInfo( "description" )
		};
		
		Clockwork.entity:SetDoorUnownable(data.entity, false);
		Clockwork.entity:SetDoorText(data.entity, false);
		Clockwork.entity:SetDoorName(data.entity, data.name);
		
		cwDoorCmds.doorData[data.entity] = data;
		cwDoorCmds:SaveDoorData();
		
		Clockwork.player:Notify(Ply, "You have set an ownable door.");
	else
		Clockwork.player:Notify(Ply, "This is not a valid door!");
	end;
end


function TOOL:RightClick( tr )

	local Clockwork = Clockwork
	local description		= self:GetClientInfo( "description" )


	if (tr.Entity:GetClass() == "player") then return false end
	if (CLIENT) then return true end

	local Ply = self:GetOwner()
	local door = Ply:GetEyeTraceNoCursor().Entity;


if not Ply:IsAdmin() then 
	return false
end
	if (IsValid(door) and Clockwork.entity:IsDoor(door)) then
		local data = {
			customName = true,
			position = door:GetPos(),
			entity = door,
			name = description or self:GetClientInfo( "description" )
		};
		
		Clockwork.entity:SetDoorUnownable(data.entity, false);
		Clockwork.entity:SetDoorText(data.entity, false);
		Clockwork.entity:SetDoorName(data.entity, data.name);
		
		cwDoorCmds.doorData[data.entity] = data;
		cwDoorCmds:SaveDoorData();
		
		Clockwork.player:Notify(Ply, "You have set an ownable door.");
	else
		Clockwork.player:Notify(Ply, "This is not a valid door!");
	end;
end




function TOOL.BuildCPanel( CPanel )

	-- HEADER
	CPanel:AddControl( "Header", { Text = "#tool.doorsetownable.name", Description	= "#tool.doorsetownable.desc" }  )
	
									
	local CVars = {"doorsetownable_description" }

									 
	CPanel:AddControl( "TextBox", { Label = "#tool.doorsetownable.text",
									 MaxLenth = "20",
									 Command = "doorsetownable_description" } )
end
