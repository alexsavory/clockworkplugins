TOOL.Category		= "Clockwork Tools [Tru]"
TOOL.Name			= "#Tool.doorsetunownable.name"
TOOL.Command		= nil
TOOL.ConfigName		= ""


if CLIENT then
	language.Add( "Tool.doorsetunownable.name", "Door Set Unownable" )
	language.Add( "Tool.doorsetunownable.desc", "Make a door unownable." )
	language.Add( "Tool.doorsetunownable.0", "Primary: Set   (Todo: Secondary: Copy   Reload: Reset)" )
	language.Add( "Tool.doorsetunownable.descriptiontext", "The Description" )
	language.Add( "Tool.doorsetunownable.nametext", "The Name" )
end

TOOL.ClientConVar[ "description" ]		= ""
TOOL.ClientConVar[ "doorname" ]		= ""


function TOOL:LeftClick( tr )

	local ply = self:GetOwner()
	
if not ply:IsAdmin() then 
	return false
end
	local doorname = self:GetClientInfo( "doorname" )
	local description = self:GetClientInfo( "description" )

	if (tr.Entity:GetClass() == "player") then return false end
	if (CLIENT) then return true end

	local Ply = self:GetOwner()
	local door = Ply:GetEyeTraceNoCursor().Entity;
	
	if (IsValid(door) and Clockwork.entity:IsDoor(door)) then
		local data = {
			position = door:GetPos(),
			entity = door,
			text = description or self:GetClientInfo( "description" ),
			name = doorname or self:GetClientInfo( "doorname" )
		};
		
		Clockwork.entity:SetDoorName(data.entity, data.name);
		Clockwork.entity:SetDoorText(data.entity, data.text);
		Clockwork.entity:SetDoorUnownable(data.entity, true);
		
		cwDoorCmds.doorData[data.entity] = data;
		cwDoorCmds:SaveDoorData();
		
		Clockwork.player:Notify(Ply, "You have set an unownable door.");
	else
		Clockwork.player:Notify(Ply, "This is not a valid door!");
	end;

end





function TOOL.BuildCPanel( CPanel )

	-- HEADER
	CPanel:AddControl( "Header", { Text = "#tool.doorsetunownable.name", Description	= "#tool.doorsetunownable.desc" }  )
	
									
	local CVars = {"doorsetunownable_description" }

									 
	CPanel:AddControl( "TextBox", { Label = "#tool.doorsetunownable.descriptiontext",
									 MaxLenth = "20",
									 Command = "doorsetunownable_description" } )

	CPanel:AddControl( "TextBox", { Label = "#tool.doorsetunownable.nametext",
									 MaxLenth = "20",
									 Command = "doorsetunownable_doorname" } )
end
