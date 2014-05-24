TOOL.Category		= "Clockwork Tools [Tru]"
TOOL.Name			= "#Tool.doorsethidden.name"
TOOL.Command		= nil
TOOL.ConfigName		= ""


if CLIENT then
	language.Add( "Tool.doorsethidden.name", "Door Set Hidden" )
	language.Add( "Tool.doorsethidden.desc", "Make a door hidden." )
	language.Add( "Tool.doorsethidden.0", "Primary: Set   (Todo: Secondary: Copy   Reload: Reset)" )
	language.Add( "Tool.doorsethidden.descriptiontext", "Is Hidden?" )
	language.Add( "Tool.doorsethidden.toggle", "I have no idea what it does." )
	language.Add( "Tool.doorsethidden.toggle.help", "Honestly, I don't know. I think it does the same as doorsetfalse." )
end

TOOL.ClientConVar[ "toggle" ]		= ""



function TOOL:LeftClick( tr )
local Clockwork = Clockwork
	local ply = self:GetOwner()
	
	local toggle = self:GetClientInfo( "toggle" )
	
if not ply:IsAdmin() then 
	return false
end

	if (tr.Entity:GetClass() == "player") then return false end
	if (CLIENT) then return true end

	local Ply = self:GetOwner()
	local door = Ply:GetEyeTraceNoCursor().Entity;
	
if (IsValid(door) and Clockwork.entity:IsDoor(door)) then
		if (Clockwork.kernel:ToBool(toggle)) then
			local data = {
				position = door:GetPos(),
				entity = door
			};				
		
			Clockwork.entity:SetDoorHidden(door, true);
			
			cwDoorCmds.doorData[data.entity] = {
				position = door:GetPos(),
				entity = door,
				text = "hidden",
				name = "hidden"
			};
			
			cwDoorCmds:SaveDoorData();
			
			Clockwork.player:Notify(ply, "You have hidden this door.");
		else
			Clockwork.entity:SetDoorHidden(door, false);
			
			cwDoorCmds.doorData[door] = nil;
			cwDoorCmds:SaveDoorData();
			
			Clockwork.player:Notify(ply, "You have unhidden this door.");
		end;
	else
		Clockwork.player:Notify(ply, "This is not a valid door!");
	end;

end





function TOOL.BuildCPanel( CPanel )

	-- HEADER
	CPanel:AddControl( "Header", { Text = "#tool.doorsethidden.name", Description	= "#tool.doorsethidden.desc" }  )
	
									
	local CVars = {"doorsethidden_toggle" }

									 
	CPanel:AddControl( "CheckBox",	{ Label = "#tool.doorsethidden.toggle", Command = "doorsethidden_toggle", Help=true }  )
end
