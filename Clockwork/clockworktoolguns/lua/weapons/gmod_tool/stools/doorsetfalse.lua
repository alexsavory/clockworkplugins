TOOL.Category		= "Clockwork Tools [Tru]"
TOOL.Name			= "#Tool.doorsetfalse.name"
TOOL.Command		= nil
TOOL.ConfigName		= ""


if CLIENT then
	language.Add( "Tool.doorsetfalse.name", "Door Set False" )
	language.Add( "Tool.doorsetfalse.desc", "Make a door false." )
	language.Add( "Tool.doorsetfalse.0", "Primary: Set " )
	language.Add( "Tool.doorsetfalse.descriptiontext", "Is False?" )
	language.Add( "Tool.doorsetfalse.toggle", "Toggle 'Falseness'" )
	language.Add( "Tool.doorsetfalse.toggle.help", "Ticking this will remove any settings on a door, leaving it unticked will make it ownable." )
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
		
			Clockwork.entity:SetDoorFalse(door, true);
			
			cwDoorCmds.doorData[data.entity] = {
				position = door:GetPos(),
				entity = door,
				text = "hidden",
				name = "hidden"
			};
			
			cwDoorCmds:SaveDoorData();
			
			Clockwork.player:Notify(ply, "You have made this door false.");
		else
			Clockwork.entity:SetDoorFalse(door, false);
			
			cwDoorCmds.doorData[door] = nil;
			cwDoorCmds:SaveDoorData();
			
			Clockwork.player:Notify(ply, "You have no longer made this door false.");
		end;
	else
		Clockwork.player:Notify(ply, "This is not a valid door!");
	end;

end





function TOOL.BuildCPanel( CPanel )

	-- HEADER
	CPanel:AddControl( "Header", { Text = "#tool.doorsetfalse.name", Description	= "#tool.doorsetfalse.desc" }  )
	
									
	local CVars = {"doorsetfalse_toggle" }

									 
	CPanel:AddControl( "CheckBox",	{ Label = "#tool.doorsetfalse.toggle", Command = "doorsetfalse_toggle", Help=true }  )
end
